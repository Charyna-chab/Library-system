<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;
    protected $fillable = ['FirstName', 'LastName', 'Nationality'];

    public function books()
    {
        return $this->hasMany(Books::class);
    }
}
