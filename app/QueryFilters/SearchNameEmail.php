<?php

namespace App\QueryFilters;

use Closure;

class SearchNameEmail extends Filter
{
   protected function applyFilter($builder)
   {
    if(request($this->filterName())){

       return $builder->where('email', 'LIKE', '%' . request($this->filterName()) . '%')->orWhere('email', 'LIKE', '%' . request($this->filterName()) . '%');
    }
    return $builder;
   }
}
