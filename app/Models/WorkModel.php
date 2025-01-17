<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkModel extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'work_user');
    }
}
