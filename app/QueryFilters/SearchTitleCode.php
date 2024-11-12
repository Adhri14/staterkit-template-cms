<?php

namespace App\QueryFilters;

use Closure;

class SearchTitleCode extends Filter
{
    protected function applyFilter($builder)
    {
        if(request($this->filterName())){
            return $builder->where('title', 'LIKE', '%' . request($this->filterName()) .  '%')->orWhere('code', 'LIKE', '%' . request($this->filterName()) . '%');
        }
        return $builder;
    }
}
