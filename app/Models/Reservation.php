<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reservations';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'initial_price',
        'price',
        'date',
        'status',
        'user_id',
        'segmentation_id',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function segmentation()
    {
        return $this->belongsTo(Segmentation::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
