<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemCondition;
use App\Models\PrimaryCategory;
use Illuminate\Http\Request;
use App\Http\Requests\SellRequest;
use Illuminate\Support\Facades\Auth;

class SellController extends Controller
{
    public function showSellForm()
    {
        $categories = PrimaryCategory::orderBy('sort_no')
            ->with(['secondaryCategories'])->get();

        $conditions = ItemCondition::orderBy('sort_no')->get();
        
        return view('sell', [
            'conditions' => $conditions,
            'categories' => $categories,
        ]);
    }

    public function sellItem(SellRequest $request)
    {
        $user = Auth::user();

        $item                        = new Item();
        $item->seller_id             = $user->id;
        $item->name                  = $request->input('name');
        $item->description           = $request->input('description');
        $item->secondary_category_id = $request->input('category');
        $item->item_condition_id     = $request->input('condition');
        $item->price                 = $request->input('price');
        $item->state                 = Item::STATE_SELLING;
        $item->save();

        return redirect()->route('sell', [
            'status' => '商品を出品しました。',
        ]);
        // return redirect()->back()
        // ->with('status', '商品を出品しました。');
        
    }
}
