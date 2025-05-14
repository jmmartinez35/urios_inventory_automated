<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Item;
use App\Services\BorrowingService;
use Illuminate\Support\Facades\Auth;



class FrontendController extends Controller
{
    protected $borrowingService; 

    public function __construct(BorrowingService $borrowingService)
    {
        $this->borrowingService = $borrowingService; 
    }

    public function index()
    {
        $this->borrowingService->removeRestrictionsForClearedUsers();
       
        $this->borrowingService->autoCancelBorrowings(); 
        $this->borrowingService->sendBorrowingDeadlineReminders(); 
       
        $items = Item::orderBy('created_at', 'DESC')
        ->get();
        return view('frontend.index', compact('items'));
    }

    public function item($uuid)
    {
        $item = Item::where('uuid', $uuid)->firstOrFail();

        return view('frontend.items.single.index', compact('item'));
    }

    public function categories_base($slug)
    {
        $category = Category::where('name', $slug)->firstOrFail();
        $items = Item::where('category_id', $category->id)
            ->orderBy('created_at', 'DESC')
            ->get();

           
        return view('frontend.index', compact( 'items'));
    }

    public function cart()
    {
        if (!Auth::check()) {
            return redirect()->route('login.custom');
        }
       
        return view('frontend.cart.index');
 
    }

    public function search()
    {
       
        return view('frontend.search.result');
 
    }

    
   

}
