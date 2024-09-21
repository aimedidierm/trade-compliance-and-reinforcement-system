<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'packaging_number',
        'currier',
        'ship_via',
        'date',
        'address',
        'tracking_number',
        'status',
        'sale_id',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
