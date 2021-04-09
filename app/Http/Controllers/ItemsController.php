<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ItemsController extends Controller
{
    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '_'],
            $value
        );
    }

    public function showItems(Request $request)
    {
        $query = Item::query();

        // カテゴリで絞り込み
        if ($request->filled('category')) {
            list($categoryType, $categoryID) = explode(':', $request->input('category'));

            if ($categoryType === 'primary') {
                $query->whereHas('secondaryCategory', function ($query) use ($categoryID) {
                    $query->where('primary_category_id', $categoryID);
                });
            } else if ($categoryType === 'secondary') {
                $query->where('secondary_category_id', $categoryID);
            }
        }

        // キーワードで絞り込み
        if ($request->filled('keyword')) {
            $keyword = '%' . $this->escape($request->input('keyword')) . '%';
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', $keyword);
                $query->orWhere('description', 'LIKE', $keyword);
            });
        }

        $items = $query->orderByRaw("FIELD(state, '" .Item::STATE_SELLING. "', '".Item::STATE_BOUGHT . "' )")
            ->orderBy('id', 'DESC')
            ->paginate(52);

        return view('items.items',[
            'items' => $items,
        ]);
    }

    public function showItemDetail(Item $item)
    {
        return view('items.item_detail', [
            'item' => $item,
        ]);
    }

    public function showByItemForm(Item $item)
    {
        if (!$item->isStateSelling) {
            abort(404);
        }
        
        return view('items.item_buy_form', [
            'item' => $item
            ]);
    }

    public function byItem(Request $request, Item $item)
    {
        $user = Auth::user();

        if (!$item->is_state_selling) {
            abort(404);
        }

        $token = $request->input('card-token');

        try {
            $this->settlement($item->id, $item->seller->id, $user->id, $token);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()
                ->with('type', 'denger')
                ->with('message', '商品を購入しました。');
        }

        return redirect()->route('item', [
            $item->id,
            'message' => '商品を購入しました。',
            ]);
    }

        private function settlement($itemID, $sellerID, $buyerID, $token)
        {
            DB::beginTransaction();

            try {
                $seller = User::lockForUpdate()->find($sellerID);
                $item = Item::lockForUpdate()->find($itemID);

                if ($item->isStateBought) {
                    throw new \Exception('多重決済');
                }

                $item->state        = Item::STATE_BOUGHT;
                $item->bought_at    = Carbon::now();
                $item->buyer_id     = $buyerID;
                $item->save();

                $seller->sales += $item->price;
                $seller->save();

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

            DB::commit();
        }


}
