<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'address',
        'quantity',
        'price',
        'weight',
        'status',
        'shipment_id',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
