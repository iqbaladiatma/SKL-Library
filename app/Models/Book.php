<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['image','title', 'author', 'description', 'stock'];
    protected $guarded = [];
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
