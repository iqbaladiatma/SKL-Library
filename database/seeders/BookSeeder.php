<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Pindahkan data buku dari DatabaseSeeder ke sini
        $books = [
            [
                'title' => 'Petualangan di Negeri Ajaib',
                'author' => 'Sarah Johnson',
                'description' => 'Kisah petualangan seorang anak yang menemukan dunia ajaib di balik lemari tua.',
                'content' => 'BAB 1: PENEMUAN YANG MENGEJUTKAN...',
                'image' => 'books/book1.jpg',
                'stock' => 5
            ],
            // ... buku lainnya
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
