<?php

namespace App\QueryFilters;

use Closure;

class SearchRole extends Filter
{
   protected function applyFilter($builder)
   {
    if(request($this->filterName())){

       return $builder->where('role', request($this->filterName()));
    }
    return $builder;
   }
}
