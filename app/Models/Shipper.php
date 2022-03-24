<?php

namespace App\Models;

use App\Models\ShipperType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipper extends Model
{
    use HasFactory;

    public function shipperType()
    {
        return $this->belongsTo(ShipperType::class);
    }
}
