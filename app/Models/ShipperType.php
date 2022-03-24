<?php

namespace App\Models;

use App\Models\Shipper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipperType extends Model
{
    use HasFactory;

    public function shipper()
    {
        return $this->hasMany(Shipper::class);
    }
}
