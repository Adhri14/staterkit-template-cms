<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class RedeemExport implements FromView
{
    private $_results;
	private $start_date;
	private $end_date;
	/**
	 * Create a new exporter instance.
	 *
	 * @param array $results query result
	 *
	 * @return void
	 */
	public function __construct($results, $start_date, $end_date)
	{
		$this->_results = $results;
		$this->start_date = $start_date;
		$this->end_date = $end_date;
	}

	/**
	 * Load the view.
	 *
	 * @return void
	 */
	public function view(): View
	{
		
		return view(
			'export.redeem_xls',
			[
				'data' => $this->_results,
				'start_date' => $this->start_date,
				'end_date' => $this->end_date
			]
		);
	}
}
