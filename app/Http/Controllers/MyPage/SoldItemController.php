<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class SoldItemController extends Controller
{
    public function showSoldItems()
    {
        $user = Auth::user();

        $items = $user->solditems()->orderBy('id', 'DESC')->get();
        
        // ddd($items);
        return view('mypage.sold_items', [
            'items' => $items,
        ]);
    }

}
