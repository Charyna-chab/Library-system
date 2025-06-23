<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;
    protected $fillable = ['borrowed-at','returned_at'];

    public function Books(){
        return $this->belongsTo(Books::class);
    }
}
