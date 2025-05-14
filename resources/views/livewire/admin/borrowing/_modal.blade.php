<div wire:ignore.self class="modal fade" id="confirmMarkDoneModal" tabindex="-1" aria-labelledby="markModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <form wire:submit.prevent="completeBorrowing">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Returned Borrowing - Check Damages</h1>
                </div>
                <div class="modal-body">

                    <div class="mt-2">
                        <h6>Specify damaged/defective quantity for each item:</h6>
                        @foreach ($cartList as $cart)
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ $cart->item->name }} (Borrowed: {{ $cart->quantity }})
                                </label>
                                <input type="number" wire:model.defer="damagedQuantities.{{ $cart->item->id }}"
                                    min="0" max="{{ $cart->quantity }}" class="form-control"
                                    oninput="this.value = Math.min(this.max, Math.max(this.min, this.value));"
                                    placeholder="Enter damaged quantity (0 if none)">

                                <input type="text" wire:model.defer="damageNotes.{{ $cart->item->id }}"
                                    class="form-control mt-1"
                                    placeholder="Optional note about the damage (e.g. broken screen)">
                            </div>
                        @endforeach
                    </div>


                </div>
                <div class="modal-footer">

                    @if ($users?->user_status == 2)
                        <button type="submit" class="btn btn-secondary" wire:click="continueWithRestriction">
                            leave the restriction
                        </button>
                        <button type="submit" class="btn btn-primary" wire:click="continueRemoveRestriction">
                            remove the restriction
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    @endif

                </div>
            </div>
        </form>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <form wire:submit.prevent="declinedBorrowing"> <!-- Change to declinedBorrowing -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Decline Borrowing</h1>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="remarks_msg" class="form-label">Remarks (Optional)</label>
                        <textarea class="form-control" wire:model.defer="remarks_msg" id="remarks_msg" cols="5" rows="2"
                            placeholder="Enter reason for decline (optional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetData">Close</button>
                    <button type="submit" class="btn btn-danger">Decline Borrowing</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="viewDetailModal" tabindex="-1" aria-labelledby="cancelModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <form wire:submit.prevent="declinedBorrowing"> <!-- Change to declinedBorrowing -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Borrowing Details</h1>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-7">

                            <div class="card shadow-sm p-3 mt-1 rounded-0" style="border-top: 15px solid #120D4F;">
                                @if ($borrowDetails?->status != 3 && $borrowDetails?->status != 2 && $borrowDetails?->status != 0)
                                    <div class="alert alert-warning text-center m-0 p-2">
                                        <i class="fa-solid fa-exclamation-circle"></i>
                                        <strong>Reminder:</strong> Please verify that the listed items match the actual
                                        items being returned by
                                        the borrower.
                                    </div>
                                    <hr>
                                @endif

                                <table class="table cart-table">
                                    <thead>
                                        <tr class="table-head">
                                            <th scope="col">Item</th>
                                            <th scope="col">Stock Quantity</th>

                                            <th scope="col">Quantity</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    <tbody>
                                        @if ($cartList->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">
                                                    <i class="fas fa-shopping-cart fa-2x mt-4"></i>
                                                    <p>Your cart is empty.</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($cartList as $cart)
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset($cart->item->image_path ? 'storage/' . $cart->item->image_path : 'images/not_available.jpg') }}"
                                                            alt="{{ $cart->item->name }}" class="img-thumbnail me-2"
                                                            style="width: 50px; height: 50px; object-fit: cover;">
                                                        <span title="{{ ucfirst($cart->item->name) }}">
                                                            {{ Str::limit(ucfirst($cart->item->name), 20, '...') }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        {{ $cart->item->quantity }}

                                                    </td>
                                                    <td>
                                                        {{ $cart->quantity }}

                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="card shadow-sm mt-2 p-3 rounded-0 position-relative"
                                style="border-top: 5px solid #120D4F;">
                                <h6 class="mb-3 theme-color">BORROWER DETAILS </h6>
                                <div class="mb-2">
                                    <label for="name" class="form-label">NAME</label>
                                    <input type="text" readonly class="form-control" id="name"
                                        name="name"
                                        value="{{ optional($userDetails)->firstname ? Str::ucfirst($userDetails->firstname) . ' ' . Str::ucfirst($userDetails->middlename) . ' ' . Str::ucfirst($userDetails->lastname) : '' }}"
                                        placeholder="N/A">
                                </div>
                                <div class="mb-2">
                                    <label for="name" class="form-label">User Type</label>
                                    <input type="text" readonly class="form-control" id="name"
                                        name="name" value="{{ optional($userDetails)->position }}"
                                        placeholder="N/A">
                                </div>

                            </div>
                            <div class="card shadow-sm mt-2 p-3 rounded-0 position-relative"
                                style="border-top: 5px solid #120D4F;">
                                <h6 class="mb-3 theme-color">BORROW DETAILS</h6>

                                <div class="mb-2">
                                    <label for="start_date" class="form-label">DATE OF USAGE (FROM)</label>
                                    <input type="text" readonly class="form-control" id="start_date"
                                        name="start_date"
                                        value="{{ $borrowDetails?->start_date ? \Carbon\Carbon::parse($borrowDetails->start_date)->translatedFormat('F d, Y') : 'N/A' }}"
                                        placeholder="N/A">
                                </div>

                                <div class="mb-2">
                                    <label for="end_date" class="form-label">DATE OF USAGE (TO)</label>
                                    <input type="text" readonly class="form-control" id="end_date"
                                        name="end_date"
                                        value="{{ $borrowDetails?->end_date ? \Carbon\Carbon::parse($borrowDetails->end_date)->translatedFormat('F d, Y') : 'N/A' }}"
                                        placeholder="N/A">
                                </div>
                                <div class="mb-2">
                                    <label for="name" class="form-label">REMARKS</label>
                                    <input type="text" readonly class="form-control" id="name"
                                        name="name"
                                        value="{{ optional($borrowDetails) ? $borrowDetails?->reason : '' }}"
                                        placeholder="N/A">
                                </div>
                                <!-- Overdue or Remaining Days Message -->
                                @if ($borrowDetails?->status != 3 && $borrowDetails?->status != 2)
                                    @if ($overdueDays > 0)
                                        <div class="alert alert-danger text-center">
                                            <i class="fa-solid fa-exclamation-triangle"></i>
                                            This borrowing is <strong>{{ $overdueDays }} days overdue!</strong>

                                        </div>
                                    @elseif ($remainingDays > 0)
                                        <div class="alert alert-success text-center">
                                            <i class="fa-solid fa-clock"></i>
                                            <strong>{{ $remainingDays }} days left</strong> before the due
                                            date.
                                        </div>
                                    @else
                                        <div class="alert alert-warning text-center">
                                            <i class="fa-solid fa-info-circle"></i>
                                            No due date information available.
                                        </div>
                                    @endif

                                @endif

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetData">Close</button>
                    @if ($borrowDetails?->status != 3 && $borrowDetails?->status != 2 && $borrowDetails?->status != 1)
                        <button type="button" data-bs-toggle="modal" data-bs-target="#cancelModal"
                            wire:loading.attr="disabled" wire:target="declinedBorrowing"
                            class="btn btn-danger">DISAPPROVED</button>
                    @endif

                    @if ($borrowDetails?->status == 0)
                        <button type="button" wire:click="approveBorrowing" wire:loading.attr="disabled"
                            wire:target="approveBorrowing" class="btn btn-primary">APPROVED</button>
                    @endif

                    @if ($borrowDetails?->status == 1)
                        <button type="button" data-bs-target="#confirmMarkDoneModal" data-bs-toggle="modal"
                            data-bs-dismiss="modal" class="btn btn-primary">
                            Mark as Done
                        </button>
                    @endif




                </div>
            </div>
        </form>
    </div>
</div>
