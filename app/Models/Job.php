<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'staff_id',
        'mall_id',
        'start_date',
        'end_date',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function mall()
    {
        return $this->belongsTo(Mall::class);
    }
}
