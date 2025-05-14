<?php

namespace App\Services;

use App\Models\Remarks;
use App\Models\User;
use App\Models\Borrowing;
use App\Models\Cart;
use App\Notifications\CustomerNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // For logging errors

class BorrowingService
{
    public function autoCancelBorrowings()
    {
        $now = Carbon::now();

        $pendingBorrowings = Borrowing::where('status', 0)->get();

        foreach ($pendingBorrowings as $borrow) {
            $deadline = $borrow->end_date;
            try {
                if ($now->greaterThan(Carbon::parse($deadline)) && $now->hour >= 17) {
                    $borrow->update([
                        'status' => 2,
                        'approved_by' => Auth::id() ?? null,
                    ]);

                    Remarks::create([
                        'remarks_msg' => 'Auto-cancelled: Deadline reached without approval.',
                        'borrowing_id' => $borrow->id,
                    ]);

                    $user = User::find($borrow->user_id);

                    if ($user) {
                        $link = route('cart.status', ['uuid' => $borrow->uuid]);
                        $details = [
                            'greeting' => "Borrowing Request Cancelled",
                            'body' => "Your borrowing request has been automatically cancelled because it was not approved before 5:00 PM or exceeded the deadline.",
                            'lastline' => '',
                            'regards' => "Please visit: $link"
                        ];

                        // Attempt to send notification, catch failure
                        try {
                            Notification::send($user, new CustomerNotification($details));
                        } catch (\Exception $e) {
                            Log::error("Error sending notification to user {$user->id}: " . $e->getMessage());
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error("Error processing borrowing ID {$borrow->id}: " . $e->getMessage());
            }
        }
    }

    public function sendBorrowingDeadlineReminders()
    {
        $now = Carbon::now();

        $borrowings = Borrowing::where('status', 1)->get(); // status 1 = borrowed

        foreach ($borrowings as $borrow) {
            $deadline = $borrow->end_date;
            $deadlineDate = Carbon::parse($deadline);
            $user = User::find($borrow->user_id);

            if (!$user) {
                continue;
            }

            $link = route('cart.status', ['uuid' => $borrow->uuid]);

            try {
                if ($now->isSameDay($deadlineDate)) {
                    $details = [
                        'greeting' => "Borrowing Reminder",
                        'body' => "Reminder: Your borrowing deadline is today. Please return or renew your borrowed items.",
                        'lastline' => '',
                        'regards' => "View your borrowing status: $link"
                    ];
                    Notification::send($user, new CustomerNotification($details));
                } elseif ($now->diffInDays($deadlineDate, false) === 1) {
                    $details = [
                        'greeting' => "Borrowing Reminder",
                        'body' => "Heads up! Your borrowing deadline is tomorrow. Please prepare to return or renew your borrowed items.",
                        'lastline' => '',
                        'regards' => "View your borrowing status: $link"
                    ];
                    Notification::send($user, new CustomerNotification($details));
                } elseif ($now->greaterThan($deadlineDate)) {
                    $overdueDays = $now->diffInDays($deadlineDate);

                    $user->update([
                        'user_status' => 2,
                        'restricted_until' => $now->copy()->addDays(5),
                    ]);


                    $details = [
                        'greeting' => "Borrowing Overdue",
                        'body' => "Your borrowing deadline has passed by {$overdueDays} day(s). Your borrowing privileges are now restricted for 5 days.",
                        'lastline' => '',
                        'regards' => "Please return your items. View details: $link"
                    ];
                    Notification::send($user, new CustomerNotification($details));
                }
            } catch (\Exception $e) {
                \Log::error("Error processing borrowing ID {$borrow->id}: " . $e->getMessage());
            }
        }
    }

    public function removeRestrictionsForClearedUsers()
    {
        $restrictedUsers = User::where('user_status', 2)
            ->whereNotNull('restricted_until')
            ->get();
    
        foreach ($restrictedUsers as $user) {
            $activeBorrowings = Borrowing::where('user_id', $user->id)
                ->where('status', 1) // active
                ->get();
    
            $now = Carbon::now()->toDateString();
    
            if ($activeBorrowings->isEmpty()) {
                // No active borrowings, check if any past borrowings are NOT overdue
                $pastBorrowings = Borrowing::where('user_id', $user->id)
                    ->where('status', '!=', 1)
                    ->whereNotNull('end_date')
                    ->get();
    
                $hasOnlyOverdue = $pastBorrowings->every(function ($borrow) use ($now) {
                    return Carbon::parse($borrow->end_date)->toDateString() < $now;
                });
    
                if ($hasOnlyOverdue) {
                    $user->update([
                        'user_status' => 0, // back to active
                        'restricted_until' => null,
                    ]);
                }
            } else {
                // Has active borrowings, check if any are overdue
                $hasOverdue = $activeBorrowings->contains(function ($borrow) use ($now) {
                    return Carbon::parse($borrow->end_date)->toDateString() < $now;
                });
    
                if (!$hasOverdue) {
                    $user->update([
                        'user_status' => 1,
                        'restricted_until' => null,
                    ]);
                }
            }
        }
    }
    
}
