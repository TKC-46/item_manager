<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = false;

    protected $fillable = [
        "name",
        "price",
        "deleted_at",
        "category_id",
    ];

    public function category(): BelongsTo
    {
        // $this は Item クラスのインスタンスを指している
        // PHPの組み込みの class 定数を使用して、クラス名の文字列を取得する
        // そのためuseする必要がない
        return $this->belongsTo(Category::class);
    }
}
