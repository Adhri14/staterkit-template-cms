<?php

namespace App\QueryFilters;

use Closure;

class ProvinceId extends Filter
{
   protected function applyFilter($builder)
   {
      return $builder->where('province_id', request($this->filterName()));
   }
}
