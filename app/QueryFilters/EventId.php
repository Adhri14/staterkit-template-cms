<?php

namespace App\QueryFilters;

use Closure;

class EventId extends Filter
{
   protected function applyFilter($builder)
   {
      return $builder->where('event_id', request($this->filterName()));
   }
}
