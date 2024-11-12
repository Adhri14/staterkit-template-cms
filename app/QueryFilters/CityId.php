<?php

namespace App\QueryFilters;

use Closure;

class CityId extends Filter
{
   protected function applyFilter($builder)
   {
      return $builder->where('city_id', request($this->filterName()));
   }
}
