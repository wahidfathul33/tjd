<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;

class UserController extends Controller
{
    use ApiResponser;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if($validator->fails()){
            return $this->error('The given data was invalid', 400, $validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
         ]);

        //assign role
        $request->role ?? $user->assignRole($request->role);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success(
            [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 'Record successfully saved.', 201
        );
    }

    public function profile()
    {
        $data = User::withCount([
                    'transactions as unconfirmed_count' => fn($query) => $query->where('status', 'Menunggu Konfirmasi'),
                    'transactions as processed_count' => fn($query) => $query->where('status', 'Diproses'),
                    'transactions as shipped_count' => fn($query) => $query->where('status', 'Dikirim'),
                    'transactions as done_count' => fn($query) => $query->where('status', 'Selesai')
                ])->find(auth()->user()->id);
        return $this->success($data, 'Record successfully retrieved');
    }
}
