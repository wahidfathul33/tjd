<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\TransactionStatus;
use App\Http\Controllers\Controller;

class TransactionStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionStatus  $transactionStatus
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionStatus $transactionStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionStatus  $transactionStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionStatus $transactionStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionStatus  $transactionStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionStatus $transactionStatus)
    {
        //
    }
}
