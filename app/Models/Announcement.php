<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'announcements';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'header',
        'content',
        'status',
        'mall_id',
        'staff_id',
        'created_at',
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
