<?php

namespace App\Http\Controllers\Api\V1;

use Auth;
use App\Models\User;
use App\Models\UserFavorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserFavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = User::with(['favorite'])->find(auth()->user()->id);
        $data = User::with(['favorites'])->find(3);

        if($data->favorite->isEmpty()){
            abort(404, 'as');
        }

        return $data->favorite;
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
     * @param  \App\Models\UserFavorite  $userFavorite
     * @return \Illuminate\Http\Response
     */
    public function show(UserFavorite $userFavorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserFavorite  $userFavorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserFavorite $userFavorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserFavorite  $userFavorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserFavorite $userFavorite)
    {
        //
    }
}
