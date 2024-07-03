<?php

namespace App\Http\Repositories;

use App\Models\LogUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class LogUserRepository
{
    const CACHE_KEY = 'LOG_USER';

    public function pluck($name, $id)
    {
        $key = "pluck.{$name}.{$id}";
        $cacheKey = $this->getCacheKey($key);
        return LogUser::pluck($name, $id);
        // return Cache::tags(['log_users'])->remember($cacheKey, Carbon::now()->addMonths(6), function () use ($name, $id) {
        //     return LogUser::pluck($name, $id);
        // });
    }
    public function all()
    {
        $keys = $this->requestValue();
        $key = "all.{$keys}}";
        $cacheKey = $this->getCacheKey($key);
        return LogUser::allWithFilters();
        // return Cache::tags(['log_users'])->remember($cacheKey, Carbon::now()->addMonths(6), function () {
        //     return LogUser::allWithFilters();
        // });
    }

    public function paginate($number)
    {
        $keys = $this->requestValue();
        $key = "paginate.{$number}.{$keys}";
        $cacheKey = $this->getCacheKey($key);

        return LogUser::paginateWithFilters($number);
        // return Cache::tags(['log_users'])->remember($cacheKey, Carbon::now()->addMonths(6), function () use ($number) {
        //     return LogUser::paginateWithFilters($number);
        // });
    }

    public function paginateTrash($number)
    {
		request()->merge(['trash' => '1']);
        $keys = $this->requestValue();
        $key = "paginateTrash.{$number}.{$keys}";
        $cacheKey = $this->getCacheKey($key);

        return LogUser::paginateWithFilters($number);
        // return Cache::tags(['log_users'])->remember($cacheKey, Carbon::now()->addMonths(6), function () use ($number) {
        //     return LogUser::paginateWithFilters($number);
        // });
    }

    public function countTrash()
    {
        $key = "countTrash";
        $cacheKey = $this->getCacheKey($key);

        return LogUser::onlyTrashed()->count();
        // return Cache::tags(['log_users'])->remember($cacheKey, Carbon::now()->addMonths(6), function (){
        //     return LogUser::onlyTrashed()->count();
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