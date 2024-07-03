<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pipeline\Pipeline;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function paginateWithFilters($limit)
    {
        return app(Pipeline::class)
            ->send(User::query())
            ->through([
                // \App\QueryFilters\SortBy::class,
                // \App\QueryFilters\SearchFulllnameUsernameEmail::class,
                // \App\QueryFilters\SearchTitle::class,
                // \App\QueryFilters\Trash::class,
            ])
            ->thenReturn()
            ->paginate($limit);
    }

    public static function allWithFilters()
    {
        return app(Pipeline::class)
            ->send(User::query())
            ->through([
                // \App\QueryFilters\SortBy::class,
                // \App\QueryFilters\SearchFulllnameUsernameEmail::class,
                // \App\QueryFilters\SearchTitle::class,
                // \App\QueryFilters\Trash::class,
            ])
            ->thenReturn()
            ->get();
    }
}
