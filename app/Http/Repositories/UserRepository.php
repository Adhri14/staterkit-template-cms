<?php

namespace App\Http\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class UserRepository
{
    const CACHE_KEY = 'USER';

    public function pluck($name, $id)
    {
        $key = "pluck.{$name}.{$id}";
        $cacheKey = $this->getCacheKey($key);

        return User::pluck($name, $id);
        // return Cache::tags(['users'])->remember($cacheKey, Carbon::now()->addMonths(6), function () use ($name, $id) {
        //     return User::pluck($name, $id);
        // });
    }
    public function all()
    {
        $keys = $this->requestValue();
        $key = "all.{$keys}}";
        $cacheKey = $this->getCacheKey($key);

        return User::allWithFilters();
        // return Cache::tags(['users'])->remember($cacheKey, Carbon::now()->addMonths(6), function () {
        //     return User::allWithFilters();
        // });
    }
    public function getBannerLogin($row)
    {
        $keys = $this->requestValue();
        $key = "all.{$keys}}";
        $cacheKey = $this->getCacheKey($key);

        return User::limit($row)->orderBy('position','ASC')->get();
        // return Cache::tags(['users'])->remember($cacheKey, Carbon::now()->addMonths(6), function () use ($row) {
        //     return User::limit($row)->orderBy('position','ASC')->get();
        // });
    }

    public function paginate($number)
    {
        $keys = $this->requestValue();
        $key = "paginate.{$number}.{$keys}";
        $cacheKey = $this->getCacheKey($key);

        return User::paginateWithFilters($number);
        // return Cache::tags(['users'])->remember($cacheKey, Carbon::now()->addMonths(6), function () use ($number) {
        //     return User::paginateWithFilters($number);
        // });
    }

    public function paginateTrash($number)
    {
		request()->merge(['trash' => '1']);
        $keys = $this->requestValue();
        $key = "paginateTrash.{$number}.{$keys}";
        $cacheKey = $this->getCacheKey($key);

        return User::paginateWithFilters($number);
        // return Cache::tags(['users'])->remember($cacheKey, Carbon::now()->addMonths(6), function () use ($number) {
        //     return User::paginateWithFilters($number);
        // });
    }

    // public function countTrash()
    // {
    //     $key = "countTrash";
    //     $cacheKey = $this->getCacheKey($key);

    //     return User::onlyTrashed()->count();
    //     // return Cache::tags(['users'])->remember($cacheKey, Carbon::now()->addMonths(6), function (){
    //     //     return User::onlyTrashed()->count();
    //     // });
    // }
    public function getCacheKey($key)
    {
        $key = strtoupper($key);
        return Self::CACHE_KEY . ".$key";
    }

    private function requestValue()
    {
        return http_build_query(request()->all(),'','.');
    }
}
