<?php

namespace App\QueryFilters;

use Closure;

class SearchOrderCode extends Filter
{
   protected function applyFilter($builder)
   {
    if(request($this->filterName())){

       return $builder->orWhere('order_code', 'LIKE', '%' . request($this->filterName()) . '%');
    }
    return $builder;
   }
}
