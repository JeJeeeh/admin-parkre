<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Segmentation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'segmentations';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'park_space',
        'reserve_space',
        'mall_id',
        'created_at',
    ];

    public function mall()
    {
        return $this->belongsTo(Mall::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
