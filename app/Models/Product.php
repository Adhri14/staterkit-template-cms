<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'title',
        'price',
        'discount',
        'stock'
    ];

    public static function paginateWithFilters($limit)
    {
        return app(Pipeline::class)
            ->send(Product::query())
            ->through([
                // \App\QueryFilters\SortBy::class,
                // \App\QueryFilters\SearchTitle::class,
                // \App\QueryFilters\Trash::class,
            ])
            ->thenReturn()
            ->paginate($limit);
    }

    public static function allWithFilters()
    {
        return app(Pipeline::class)
            ->send(Product::query())
            ->through([
                // \App\QueryFilters\SortBy::class,
                // \App\QueryFilters\SearchTitle::class,
                // \App\QueryFilters\Trash::class,
            ])
            ->thenReturn()
            ->get();
    }
}
