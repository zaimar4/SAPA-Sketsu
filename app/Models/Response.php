<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'complaint_id',
        'massage',
    ];
    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
