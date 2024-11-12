<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class VoucherHistoryExport implements FromView
{
    private $_results;
	private $start_date;
	private $end_date;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($results, $start_date, $end_date)
	{
		$this->_results = $results;
		$this->start_date = $start_date;
		$this->end_date = $end_date;
	}

    public function view(): View
    {
        return view(
			'export.voucher_histories_xls',
			[
				'data' => $this->_results,
				'start_date' => $this->start_date,
				'end_date' => $this->end_date
			]
		);
    }
}
