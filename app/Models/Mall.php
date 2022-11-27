<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mall extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'malls';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'address',
        'park_space',
        'reserve_space',
        'created_at',
    ];

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function segmentations()
    {
        return $this->hasMany(Segmentation::class);
    }
}
