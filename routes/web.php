<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 商品一覧の表示
// get('/item', ItemController@index)
Route::get('/item', [ItemController::class, 'index'])->name("item.index");
// 商品登録ページ
Route::get('/item/add', [ItemController::class, 'showAdd'])->name("item.showAdd");
// 商品登録の実行
Route::post('/item/add', [ItemController::class, 'add'])->name("item.add");
// 商品編集ページ
// {item}はワイルドカードこのルートのパスは /item/ から始まり、その後に任意の値が続く形になります。
// 具体的な商品のIDや識別子などが入ることが想定されている
Route::get('/item/{item}', [ItemController::class, 'showEdit'])->name("item.showEdit");
// 更新処理
Route::post('/item/{item}/edit', [ItemController::class, 'edit'])->name("item.edit");
// 削除処理
Route::post('/item/{item}', [ItemController::class, 'delete'])->name("item.delete");



Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/edit/{id}', [AdminController::class, "showEdit"]);
Route::get("/admin/add", [AdminController::class, "showAdd"]);
Route::post("/admin/add", [AdminController::class, "add"]);