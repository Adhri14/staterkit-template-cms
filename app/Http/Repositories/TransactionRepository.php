<?php

namespace App\Http\Repositories;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class TransactionRepository
{
    const CACHE_KEY = 'TRANSACTION';

    public function pluck($name, $id)
    {
        $key = "pluck.{$name}.{$id}";
        $cacheKey = $this->getCacheKey($key);

        return Transaction::pluck($name, $id);
        // return Cache::tags(['transactions'])->remember($cacheKey, Carbon::now()->addMonths(6), function () use ($name, $id) {
        //     return Transaction::pluck($name, $id);
        // });
    }
    public function all()
    {
        $keys = $this->requestValue();
        $key = "all.{$keys}}";
        $cacheKey = $this->getCacheKey($key);

        return Transaction::allWithFilters();
        // return Cache::tags(['transactions'])->remember($cacheKey, Carbon::now()->addMonths(6), function () {
        //     return Transaction::allWithFilters();
        // });
    }
    // public function findBySlug($slug)
    // {
    //     $key = "findBySlug.{$slug}";
    //     $cacheKey = $this->getCacheKey($key);
    //     return Cache::tags(['transactions'])->remember($cacheKey, Carbon::now()->addMonths(6), function () use ($slug) {
    //         return Transaction::findBySlug($slug);
    //     });
    // }

    public function paginate($number)
    {
        $keys = $this->requestValue();
        $key = "paginate.{$number}.{$keys}";
        $cacheKey = $this->getCacheKey($key);

        return Transaction::paginateWithFilters($number);
        // return Cache::tags(['transactions'])->remember($cacheKey, Carbon::now()->addMonths(6), function () use ($number) {
        //     return Transaction::paginateWithFilters($number);
        // });
    }

    public function paginateTrash($number)
    {
		request()->merge(['trash' => '1']);
        $keys = $this->requestValue();
        $key = "paginateTrash.{$number}.{$keys}";
        $cacheKey = $this->getCacheKey($key);

        return Transaction::paginateWithFilters($number);
        // return Cache::tags(['transactions'])->remember($cacheKey, Carbon::now()->addMonths(6), function () use ($number) {
        //     return Transaction::paginateWithFilters($number);
        // });
    }

    public function countTrash()
    {
        $key = "countTrash";
        $cacheKey = $this->getCacheKey($key);

        return Transaction::onlyTrashed()->count();
        // return Cache::tags(['transactions'])->remember($cacheKey, Carbon::now()->addMonths(6), function (){
        //     return Transaction::onlyTrashed()->count();
        // });
    }
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
