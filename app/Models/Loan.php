<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    protected $fillable = ['user_id', 'book_id', 'pinjam_at', 'balik_at'];
    protected $guarded = [];
    /** @use HasFactory<\Database\Factories\LoanFactory> */
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
