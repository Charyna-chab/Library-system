<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $fillable = ['title','category_id','author_id'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Author(){
        return $this->belongsTo(Authors::class);
    }

    public function Borrowing(){
        return $this->hasMany(Borrowing::class);
    }
}
