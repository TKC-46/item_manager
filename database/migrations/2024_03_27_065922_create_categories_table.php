<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id()->comment('主キー');
            $table->string('name')->comment('カテゴリ名');
            $table->timestamps();
        });

        /**
        * DBを使いテーブルのコメントを設定するための
        * クエリをクエリビルダやEloquent ORMを使わずに
        * 直接実行
        */
        DB::statement('ALTER TABLE categories COMMENT "カテゴリテーブル"');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
