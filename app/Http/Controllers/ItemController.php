<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Http\Requests\CreateItemRequest;

class ItemController extends Controller
{
    // 一覧表示ページ
    public function index(Request $request)
    {
        $sql = Item::query()
            ->whereNull('deleted_at')
            ->orderBy('id', 'ASC');

        $reData = $request->all();

        if (!empty($reData['name'])) {
            // 部分一致で検索
            $sql->where('name', 'LIKE', '%' . $reData['name'] . '%');
        }
        if (!empty($reData['price'])) {
            $sql->where('price', $reData['price']);
        }

        $items = $sql->get();
        
        return view('item.index', compact("items"));
    }

    // 商品登録ページ表示
    public function showAdd()
    {
        $categories = Category::all();
        return view('item.add', compact("categories"));
    }

    // 商品登録実行
    public function add(CreateItemRequest $request)
    {

        $item = Item::create($request->only(['name', 'price', 'category_id']));

        if($item) {
            Log::info('商品の登録が正常に行われました。', ['item_id' => $item->id]);
            return redirect()->route('item.index')->with('success', "登録に成功しました。");
        }
        Log::error('登録に失敗しました。');
        return redirect()->route('item.index')->with('success', "登録に失敗しました。");
    }


    // 商品編集ページ
    public function showEdit(Item $item)
    {
        $categories = Category::all();
        return view('item.edit', compact('item', 'categories'));
    }

    // 商品編集の実行
    public function edit(Item $item, Request $request)
    {
        $item->fill($request->all())->save();
        return redirect()->route('item.index')->with('success', "ID: {$item->id}を更新しました。");
    }

    // 削除の実行
    public function delete(Item $item)
    {
        $item->delete();
        return redirect()->route('item.index')->with('success', "ID: {$item->id} 商品名: {$item->name} を削除しました。");
    }
}
