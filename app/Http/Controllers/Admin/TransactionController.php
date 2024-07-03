<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\TransactionCardResource;
use App\Http\Resources\Backend\TransactionResource;
use App\Models\Product;
use Facades\App\Http\Repositories\TransactionRepository;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function index()
    {
        // return Inertia::render('Views/transaction/index');
        $transactions = TransactionRepository::paginate(20);
        return Inertia::render('Views/transaction/index', [
            'title' => 'Transactions',
            'transactions' => TransactionCardResource::collection($transactions),
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Transaction',
                    'url' => route('transaction.index')
                ],
            ],
        ]);
    }

    public function show(Transaction $transaction)
    {
        $transaction = TransactionCardResource::make($transaction);
        return Inertia::render('Views/transaction/show', [
            'title' => 'Transaction Order Code - ' . $transaction->order_code,
            'transaction' => $transaction,
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Transaction',
                    'url' => route('transaction.index')
                ],
            ],
        ]);
    }

    public function delete($transaction)
    {
        $transaction = Transaction::find($transaction);
        $transaction->transaction_detail = json_decode($transaction->transaction_detail);

        if (count($transaction->transaction_detail) > 0) {
            foreach($transaction->transaction_detail as $item) {
                $product = Product::find($item->id);
                if (!is_null($product)) {
                    $product->increment('stock', $item->qty);
                }
            }
        }

        $transaction->delete();

        Cache::tags(['transactions', 'products'])->flush();
        return redirect()->back()->with('message', toTitle($transaction->name . ' hase been deleted'));
    }

    public function export(Request $request)
    {
        // $start_date = request('start_date') ? Carbon::parse(request('start_date')) : null;
        // $end_date = request('end_date') ? Carbon::parse(request('end_date'))->endOfDay() : null;

        $start_date = $request->start_date ? Carbon::parse($request->start_date) : null;
        $end_date = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : null;

        $transactions = Transaction::query();
        
        if (!is_null($start_date) && !is_null($end_date)) {
            $transactions  = $transactions->where(function($query) use ($start_date, $end_date) {
                $query->where('created_at','>=', $start_date)
                ->where('created_at','<=', $end_date);
            });
            // $transactions = TransactionResource::collection($transactions);
        } else if (!is_null($start_date) && is_null($end_date)) {
            $transactions  = $transactions->where('created_at','>=', $start_date);
            // $transactions = TransactionResource::collection($transactions);
        } else if (is_null($start_date) && !is_null($end_date)) {
            $transactions = $transactions->where('created_at','<=', $end_date);
            // $transactions = TransactionResource::collection($transactions);
        }

        $transactions  = $transactions->latest()->get();
        $transactions = TransactionResource::collection($transactions);
        $fileName = 'Transactions Data - Kasir Simple ('. Carbon::now()->format('d F Y H:i:s') .').xlsx';

        return Excel::download(new TransactionExport($transactions, $start_date, $end_date), $fileName);
    }
}
