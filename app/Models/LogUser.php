<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pipeline\Pipeline;

class LogUser extends Model
{
    use SoftDeletes;

    protected $table = 'log_users';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'ip_address', 
        'module', 
        'action', 
        'activity', 
        'method', 
        'module_changes',
        'url', 
        'agent',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function paginateWithFilters($limit)
    {
        return app(Pipeline::class)
            ->send(LogUser::query())
            ->through([
                // \App\QueryFilters\SortBy::class,
                // \App\QueryFilters\Trash::class,
            ])
            ->thenReturn()
            ->paginate($limit);
    }

    public static function allWithFilters()
    {
        return app(Pipeline::class)
            ->send(LogUser::query())
            ->through([
                // \App\QueryFilters\SortBy::class,
                // \App\QueryFilters\Trash::class,
                // \App\QueryFilters\Except::class,
            ])
            ->thenReturn()
            ->get();
    }
}
