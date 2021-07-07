<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['bus', 'driver'];

    public function getBusAttribute() {
        return Bus::where('id', $this->bus_id)->first()->plate_number;
    }

    public function getDriverAttribute() {
        return Driver::where('id', $this->driver_id)->first()->name;
    }
}
