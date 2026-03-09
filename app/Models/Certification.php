<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'scheme_id',
        'user_id',
        'assessor_id',
        'status',
        'execution_date',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function assessor()
    {
        return $this->belongsTo(User::class , 'assessor_id');
    }
}
