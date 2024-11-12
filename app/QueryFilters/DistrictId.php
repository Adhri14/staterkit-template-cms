<?php

namespace App\QueryFilters;

use Closure;

class DistrictId extends Filter
{
   protected function applyFilter($builder)
   {
      return $builder->where('district_id', request($this->filterName()));
   }
}
