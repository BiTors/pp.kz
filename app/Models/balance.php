<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cash'
        ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
