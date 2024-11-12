<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pipeline\Pipeline;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'transactions';
    protected $fillable = [
        'user_id',
        'order_code',
        'transaction_detail',
        'type_transaction',
        'grand_total',
        'cash',
        'refund'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->order_code =  uniquecode($model,'order_code');
        });
    }

    public static function paginateWithFilters($limit)
    {
        return app(Pipeline::class)
            ->send(Transaction::query())
            ->through([
                \App\QueryFilters\SortBy::class,
                \App\QueryFilters\SearchTitle::class,
                \App\QueryFilters\Trash::class,
            ])
            ->thenReturn()
            ->paginate($limit);
    }

    public static function allWithFilters()
    {
        return app(Pipeline::class)
            ->send(Transaction::query())
            ->through([
                \App\QueryFilters\SortBy::class,
                \App\QueryFilters\SearchTitle::class,
                \App\QueryFilters\Trash::class,
            ])
            ->thenReturn()
            ->get();
    }
}
