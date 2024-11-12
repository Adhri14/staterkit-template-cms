<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GroupPartyExport implements FromView
{
    private $_results;
	private $start_date;
	private $end_date;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($_results, $start_date, $end_date)
    {
        $this->_results = $_results;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view(): View
    {
        return view('export.group_party_xls', [
            'data' => $this->_results,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ]);
    }
}
