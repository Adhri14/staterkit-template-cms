<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $_results;
	private $start_date;
	private $end_date;

    public function __construct($_results, $start_date, $end_date)
    {
        $this->_results = $_results;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view(): View
    {
        return view('export.transaction_xls', [
            'data' => $this->_results,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ]);
    }
}
