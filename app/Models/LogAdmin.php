<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pipeline\Pipeline;

class LogAdmin extends Model
{
    use SoftDeletes;

    protected $table = 'log_admins';
    protected $dates = ['login_at', 'logout_at', 'deleted_at'];
    protected $fillable = [
        'admin_id',
        'ip_address', 
        'module', 
        'action', 
        'subject', 
        'method', 
        'module_changes',
        'url', 
        'agent', 
        'login_at', 
        'logout_at',
        'deleted_at'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public static function paginateWithFilters($limit)
    {
        return app(Pipeline::class)
            ->send(LogAdmin::query())
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
            ->send(LogAdmin::query())
            ->through([
                // \App\QueryFilters\SortBy::class,
                // \App\QueryFilters\Trash::class,
                // \App\QueryFilters\Except::class,
            ])
            ->thenReturn()
            ->get();
    }
}
