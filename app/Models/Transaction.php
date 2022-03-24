<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_address()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }

    public function transaction_items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function transaction_statuses()
    {
        return $this->hasMany(TransactionStatus::class);
    }

    public function transaction_trackings()
    {
        return $this->hasMany(TransactionTracking::class);
    }
}
