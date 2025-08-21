<?php

namespace App\Http\Controllers\Back\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\TransactionRequest;
use App\Models\Cms\Transaction;
use App\Services\Cms\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.cms.Transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.cms.Transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $transactionRequest)
    {
        $this->transactionService->store($transactionRequest);

        return redirect()->route('admin.cms.Transaction.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('back.cms.Transaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $transactionRequest, Transaction $transaction)
    {
        $this->transactionService->update($transactionRequest, $transaction);

        return redirect()->route('admin.cms.Transaction.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $this->transactionService->destroy($transaction);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data()
    {
        return $this->transactionService->data();
    }

    //function to update transaction status
    public function updateTransactionStatus(Request $request, Transaction $transaction)
    {
        $transaction->update(['status' => $request->status]);

        return response()->json(['message' => "Status berhasil diperbarui"], 200);
    }
}
