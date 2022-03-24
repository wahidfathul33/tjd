<?php

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CategoriesController;
use App\Http\Controllers\Api\V1\UserAddressController;
use App\Http\Controllers\Api\V1\UserFavoriteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//API route for register new user
Route::post('user/register', [UserController::class, 'register'])->name('user.register');
//API route for login user

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('login/{provider}', [AuthController::class,'redirectToProvider']);
    Route::get('login/{provider}/callback', [AuthController::class,'handleProviderCallback']);
});

Route::resource('category', CategoriesController::class)->except(['create', 'edit']);
Route::apiResource('user/address', UserAddressController::class)->except('create');

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('role:admin');
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');

    // API route for logout user
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('auth/refresh', [AuthController::class, 'refresh'])->name('auth.refresh');

    Route::apiResource('user/favorite', UserFavoriteController::class)->except('create');
});

Route::get('product/', function()
{
    return Product::with(['brand', 'category', 'variants'])
    ->filter()
    ->withCount(['reviews as rating' => function($query){
        $query->select(DB::raw('coalesce(round(avg(rating),0),0)'));
    }])
    ->simplePaginate(20);
});

Route::get('tes', function()
{
    $a['transaction'] = Transaction::with([
        'shipper',
        'user_address',
        'voucher',
        'user',
        'transaction_items.variant',
        'transaction_items.product',
        'transaction_statuses',
        'transaction_trackings'
        ])
        ->find(9);
    $b['data'] = $a;
    return $b;
});

// Route::get('tes/{id}', function($id)
// {
//     return Product::with(['brand', 'category', 'variants', 'reviews'])->get();
// });

Route::get('tes/{product:slug}', [ProductController::class, 'show']);

Route::get('anu', function()
{
   $a =  collect(User::where('is_admin', false)->pluck('id'));
   return count($a);
});
