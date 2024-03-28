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
    // @request 検索機能のため
    public function index(Request $request)
    {
        // クエリビルダを使い、idを昇順で取得,deleted_atに日付のないデータを表示しない(論理削除)
        $sql = Item::query()
            ->whereNull('deleted_at')
            ->orderBy('id', 'ASC');

        $reData = $request->all();

        if (!empty($reData['name'])) {
            // nameを前方一致で検索
            $sql->where('name', 'LIKE',  $reData['name'] . '%');
        }
        if (!empty($reData['price'])) {
            $sql->where('price', $reData['price']);
        }

        // getでこれまで設定していたクエリを実行、値を取得する
        // getで取得した値はCollectionクラスのインスタンスになる
        $items = $sql->get();
        // コレクションクラスなので配列に直す
        \Log::info("検索内容", [$items]);
        return view('item.index', compact("items"));
    }

    // 商品登録ページ表示
    public function showAdd()
    {
        $categories = Category::all();
        \Log::info("カテゴリ一覧", [$categories]);
        return view('item.add', compact("categories"));
    }

    // 商品登録実行
    public function add(CreateItemRequest $request)
    {

        // fill()はEloquentモデルのインスタンスから呼び出されるが、create()によりインスタンスが改めて生成するため使えない
        //　インスタンス生成から保存まで行う,onlyでfillableの代わりに保存するカラムを設定
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
        // 引数に既にidが設定されているため$item = Item::find($id);はいらない
        $categories = Category::all();
        \Log::info('検索項目', [$item]);
        return view('item.edit', compact('item', 'categories'));
    }

    // 商品編集の実行
    public function edit(Item $item, Request $request)
    {
        // $item = Item::find($id);

        $item->fill($request->all())->save();

        return redirect()->route('item.index')->with('success', "ID: {$item->id}を更新しました。");
    }

    // 削除の実行
    public function delete(Item $item)
    {
        // $item = Item::find($id);

        $item->delete();

        return redirect()->route('item.index')->with('success', "ID: {$item->id} 商品名: {$item->name} を削除しました。");
    }
}
