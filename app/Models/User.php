<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     protected function serializeDate(DateTimeInterface $date): string
     {
         return $date->format('Y-m-d H:i:s');
     }

    public function providers(): HasMany
    {
        return $this->hasMany(Provider::class,'user_id','id');
    }

    public function vouchers(): BelongsToMany
    {
        return $this->belongsToMany(Voucher::class, UserVoucher::class)
                        ->wherePivot('is_used', false)
                        ->where('start_date', '<=', now())
                        ->where('end_date', '>=', now());
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, UserFavorite::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

}
