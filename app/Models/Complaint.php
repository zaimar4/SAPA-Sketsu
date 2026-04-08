<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'category',
        'ticket_number',
        'evidence_photo',
        'is_anonymous',
        'description',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function responses()
    {
        return $this->hasMany(Response::class, 'complaint_id');
    }
}
