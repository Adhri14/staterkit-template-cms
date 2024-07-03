<?php

namespace App\Models;

use App\Traits\GetSet;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Page extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    use SoftDeletes;

    protected $table = 'pages';
    protected $dates = ['deleted_at','published_at','expired_at'];

    protected $casts = [
        'deleted_at' => 'datetime',
        'published_at' => 'datetime',
        'expired_at' => 'datetime',
    ];


    protected $fillable = [
        'admin_id',
        'parent_id',
        'title',
        'subtitle',
        'slug',
        'type',
        'url',
        'summary',
        'description',
        'template',
        'image',
        'banners',
        'options',
        'contents',
        'buttons',
        'sections',
        'meta',
        'views',
        'featured',
        'published_at',
        'expired_at',
        'deleted_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug',
                'onUpdate' => true
            ]
        ];
    }


    // public function tags(): MorphToMany
    // {
    //     return $this->morphToMany(Tag::class, 'taggable');
    // }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public static function paginateWithFilters($limit)
    {
        return app(Pipeline::class)
            ->send(Page::query())
            // ->through([
            //     \App\QueryFilters\SortBy::class,
            //     \App\QueryFilters\Type::class,
            //     \App\QueryFilters\Trash::class,
            //     \App\QueryFilters\Except::class,
            //     \App\QueryFilters\Featured::class,
            //     \App\QueryFilters\Published::class,
            //     \App\QueryFilters\SearchTitle::class,
            // ])
            ->thenReturn()
            ->paginate($limit);
    }

    public static function allWithFilters()
    {
        return app(Pipeline::class)
            ->send(Page::query())
            // ->through([
            //     \App\QueryFilters\SortBy::class,
            //     \App\QueryFilters\Type::class,
            //     \App\QueryFilters\Trash::class,
            //     \App\QueryFilters\Except::class,
            //     \App\QueryFilters\Featured::class,
            //     \App\QueryFilters\Published::class,
            //     \App\QueryFilters\SearchTitle::class,
            // ])
            ->thenReturn()
            ->get();
    }

}
