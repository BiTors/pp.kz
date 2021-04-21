<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operation extends Model
{
    protected $fillable = [
        'status',
        'cash',
    ];
    use HasFactory;

    public function User(){
        return $this->belongsTo(User::class);
    }
}
