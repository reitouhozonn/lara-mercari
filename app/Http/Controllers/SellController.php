<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemCondition;
use App\Models\PrimaryCategory;
use Illuminate\Http\Request;
use App\Http\Requests\SellRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

        $imageName = $this->saveImage($request->file('item-image'));

        $item                        = new Item();
        $item->image_file_name       = $imageName;
        $item->seller_id             = $user->id;
        $item->name                  = $request->input('name');
        $item->description           = $request->input('description');
        $item->secondary_category_id = $request->input('category');
        $item->item_condition_id     = $request->input('condition');
        $item->price                 = $request->input('price');
        $item->state                 = Item::STATE_SELLING;
        $item->save();

        // return redirect()->route('sell', [
        //     'status' => '商品を出品しました。',
        // ]);
        return redirect()->back()
        ->with('status', '商品を出品しました。');
    }

    /**
     * 商品画像をリサイズして保存
     *
     * @param UploadedFile $file アップロードされた商品画像
     * @return string ファイル名
     */
    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(300, 300)->save($tempPath);

        $filePath = Storage::disk('public')
        ->putFile('item_images', new File($tempPath));

        return basename($filePath);
    }

        /**
      * 一時的なファイルを生成してパスを返します。
      *
      * @return string ファイルパス
      */
    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
