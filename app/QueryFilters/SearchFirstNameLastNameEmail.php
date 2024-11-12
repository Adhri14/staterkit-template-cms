<?php

namespace App\QueryFilters;

use Closure;

class SearchFirstNameLastNameEmail extends Filter
{
   protected function applyFilter($builder)
   {
    if(request($this->filterName())){
      return $builder->where('first_name', 'LIKE', '%' . request($this->filterName()) . '%')
        ->orWhere('last_name', 'LIKE', '%' . request($this->filterName()) . '%')
        ->orWhere('email', 'LIKE', '%' . request($this->filterName()) . '%')
        ->orWhere('code', 'LIKE', '%' . request($this->filterName()) . '%');
    }
    return $builder;
   }
}
