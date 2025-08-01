<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    protected $fillable = [
        'image',
        'title',
        'author',
        'description',
        'content',
        'stock',
        'is_premium',
        'price',
        'category',
        'isbn',
        'published_year',
        'pages',
        'language',
        'cover_image'
    ];

    protected $guarded = [];
    protected $casts = [
        'is_premium' => 'boolean',
        'price' => 'decimal:2',
        'published_year' => 'integer',
        'pages' => 'integer'
    ];

    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function purchases()
    {
        return $this->hasMany(BookPurchase::class);
    }

    public function isPurchasedByUser($userId)
    {
        return $this->purchases()->where('user_id', $userId)->exists();
    }

    public function getCoverImageUrlAttribute()
    {
        // Cek jika kolom cover_image tidak kosong DAN filenya benar-benar ada di storage
        if ($this->cover_image && Storage::disk('public')->exists($this->cover_image)) {

            // Gunakan Storage::url() yang otomatis membuat URL yang benar
            // Ini akan mengubah "covers/namafile.png" menjadi "http://.../storage/covers/namafile.png"
            return Storage::url($this->cover_image);
        }

        // Jika tidak ada, kembalikan gambar placeholder
        return 'https://source.unsplash.com/400x600/?book,library';
    }
}
