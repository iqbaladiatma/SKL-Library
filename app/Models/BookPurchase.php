<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookPurchase extends Model
{
  protected $fillable = [
    'user_id',
    'book_id',
    'amount_paid',
    'purchase_date',
    'payment_method',
    'transaction_id'
  ];

  protected $casts = [
    'amount_paid' => 'decimal:2',
    'purchase_date' => 'datetime'
  ];

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
