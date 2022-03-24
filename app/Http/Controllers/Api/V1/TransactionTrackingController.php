<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\TransactionTracking;
use App\Http\Controllers\Controller;

class TransactionTrackingController extends Controller
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
     * @param  \App\Models\TransactionTracking  $transactionTracking
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionTracking $transactionTracking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionTracking  $transactionTracking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionTracking $transactionTracking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionTracking  $transactionTracking
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionTracking $transactionTracking)
    {
        //
    }
}
