<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\User;
use App\Models\BookPurchase;
use App\Models\Loan;

class ELibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample books
        $books = [
            [
                'title' => 'Pemrograman Web dengan Laravel',
                'author' => 'Ahmad Rizki',
                'description' => 'Buku lengkap tentang pengembangan web menggunakan framework Laravel. Cocok untuk pemula hingga tingkat lanjut.',
                'content' => '<h1>Pemrograman Web dengan Laravel</h1><p>Laravel adalah framework PHP yang powerful untuk pengembangan web modern...</p>',
                'stock' => 10,
                'is_premium' => false,
                'price' => 0,
                'category' => 'Teknologi',
                'isbn' => '978-602-123456-7',
                'published_year' => 2023,
                'pages' => 350,
                'language' => 'Indonesian',
                'image' => 'default-cover.jpg',
                'cover_image' => null,
                'pdf_file' => null,
            ],
            [
                'title' => 'Machine Learning untuk Pemula',
                'author' => 'Sarah Johnson',
                'description' => 'Panduan komprehensif untuk memulai perjalanan di dunia machine learning dan artificial intelligence.',
                'content' => '<h1>Machine Learning untuk Pemula</h1><p>Machine Learning adalah cabang dari artificial intelligence...</p>',
                'stock' => 5,
                'is_premium' => true,
                'price' => 150000,
                'category' => 'Teknologi',
                'isbn' => '978-602-123456-8',
                'published_year' => 2023,
                'pages' => 420,
                'language' => 'Indonesian',
                'image' => 'default-cover.jpg',
                'cover_image' => null,
                'pdf_file' => null,
            ],
            [
                'title' => 'Kisah Sukses Startup Indonesia',
                'author' => 'Budi Santoso',
                'description' => 'Kumpulan kisah inspiratif startup Indonesia yang berhasil mengubah industri dan memberikan dampak positif.',
                'content' => '<h1>Kisah Sukses Startup Indonesia</h1><p>Indonesia memiliki ekosistem startup yang berkembang pesat...</p>',
                'stock' => 8,
                'is_premium' => true,
                'price' => 120000,
                'category' => 'Bisnis',
                'isbn' => '978-602-123456-9',
                'published_year' => 2023,
                'pages' => 280,
                'language' => 'Indonesian',
                'image' => 'default-cover.jpg',
                'cover_image' => null,
                'pdf_file' => null,
            ],
            [
                'title' => 'Seni Fotografi Digital',
                'author' => 'Maria Garcia',
                'description' => 'Panduan lengkap fotografi digital dari teknik dasar hingga teknik profesional.',
                'content' => '<h1>Seni Fotografi Digital</h1><p>Fotografi digital telah mengubah cara kita melihat dan menangkap momen...</p>',
                'stock' => 12,
                'is_premium' => false,
                'price' => 0,
                'category' => 'Seni',
                'isbn' => '978-602-123456-0',
                'published_year' => 2022,
                'pages' => 320,
                'language' => 'Indonesian',
                'image' => 'default-cover.jpg',
                'cover_image' => null,
                'pdf_file' => null,
            ],
            [
                'title' => 'Kesehatan Mental di Era Digital',
                'author' => 'Dr. Siti Aminah',
                'description' => 'Panduan menjaga kesehatan mental di tengah kemajuan teknologi dan media sosial.',
                'content' => '<h1>Kesehatan Mental di Era Digital</h1><p>Era digital membawa banyak kemudahan, namun juga tantangan...</p>',
                'stock' => 15,
                'is_premium' => true,
                'price' => 95000,
                'category' => 'Kesehatan',
                'isbn' => '978-602-123456-1',
                'published_year' => 2023,
                'pages' => 250,
                'language' => 'Indonesian',
                'image' => 'default-cover.jpg',
                'cover_image' => null,
                'pdf_file' => null,
            ],
            [
                'title' => 'Resep Masakan Nusantara',
                'author' => 'Chef Joko',
                'description' => 'Kumpulan resep masakan tradisional Indonesia dari berbagai daerah dengan cara memasak yang mudah.',
                'content' => '<h1>Resep Masakan Nusantara</h1><p>Indonesia kaya akan kuliner tradisional yang lezat...</p>',
                'stock' => 20,
                'is_premium' => false,
                'price' => 0,
                'category' => 'Kuliner',
                'isbn' => '978-602-123456-2',
                'published_year' => 2022,
                'pages' => 180,
                'language' => 'Indonesian',
                'image' => 'default-cover.jpg',
                'cover_image' => null,
                'pdf_file' => null,
            ],
            [
                'title' => 'Investasi Saham untuk Pemula',
                'author' => 'Robert Chen',
                'description' => 'Panduan lengkap investasi saham dari nol hingga bisa menghasilkan keuntungan konsisten.',
                'content' => '<h1>Investasi Saham untuk Pemula</h1><p>Investasi saham adalah salah satu cara untuk mengembangkan kekayaan...</p>',
                'stock' => 7,
                'is_premium' => true,
                'price' => 180000,
                'category' => 'Keuangan',
                'isbn' => '978-602-123456-3',
                'published_year' => 2023,
                'pages' => 380,
                'language' => 'Indonesian',
                'image' => 'default-cover.jpg',
                'cover_image' => null,
                'pdf_file' => null,
            ],
            [
                'title' => 'Novel: Petualangan di Jakarta',
                'author' => 'Dewi Sartika',
                'description' => 'Novel fiksi yang mengisahkan petualangan seorang pemuda di kota Jakarta dengan berbagai tantangan.',
                'content' => '<h1>Petualangan di Jakarta</h1><p>Jakarta, kota metropolitan yang tak pernah tidur...</p>',
                'stock' => 25,
                'is_premium' => false,
                'price' => 0,
                'category' => 'Fiksi',
                'isbn' => '978-602-123456-4',
                'published_year' => 2023,
                'pages' => 220,
                'language' => 'Indonesian',
                'image' => 'default-cover.jpg',
                'cover_image' => null,
                'pdf_file' => null,
            ],
            [
                'title' => 'Panduan Lengkap SEO',
                'author' => 'Alex Thompson',
                'description' => 'Strategi dan teknik SEO terbaru untuk meningkatkan ranking website di mesin pencari.',
                'content' => '<h1>Panduan Lengkap SEO</h1><p>SEO (Search Engine Optimization) adalah kunci untuk meningkatkan visibilitas website...</p>',
                'stock' => 6,
                'is_premium' => true,
                'price' => 200000,
                'category' => 'Marketing',
                'isbn' => '978-602-123456-5',
                'published_year' => 2023,
                'pages' => 450,
                'language' => 'Indonesian',
                'image' => 'default-cover.jpg',
                'cover_image' => null,
                'pdf_file' => null,
            ],
            [
                'title' => 'Yoga untuk Pemula',
                'author' => 'Guru Yoga Budi',
                'description' => 'Panduan praktis yoga untuk pemula dengan pose-pose dasar dan manfaat kesehatan.',
                'content' => '<h1>Yoga untuk Pemula</h1><p>Yoga adalah praktik kuno yang menggabungkan tubuh, pikiran, dan jiwa...</p>',
                'stock' => 18,
                'is_premium' => false,
                'price' => 0,
                'category' => 'Kesehatan',
                'isbn' => '978-602-123456-6',
                'published_year' => 2022,
                'pages' => 160,
                'language' => 'Indonesian',
                'image' => 'default-cover.jpg',
                'cover_image' => null,
                'pdf_file' => null,
            ],
        ];

        foreach ($books as $bookData) {
            Book::create($bookData);
        }

        // Create sample users with balance
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('password'),
                'is_admin' => false,
                'balance' => 500000,
                'subscription_type' => 'premium',
                'subscription_expires_at' => now()->addYear(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => bcrypt('password'),
                'is_admin' => false,
                'balance' => 250000,
                'subscription_type' => 'basic',
                'subscription_expires_at' => now()->addMonths(6),
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@elibrary.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'balance' => 1000000,
                'subscription_type' => 'enterprise',
                'subscription_expires_at' => now()->addYears(2),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        // Create sample loans
        $user1 = User::where('email', 'john@example.com')->first();
        $user2 = User::where('email', 'jane@example.com')->first();
        $book1 = Book::where('title', 'Pemrograman Web dengan Laravel')->first();
        $book2 = Book::where('title', 'Seni Fotografi Digital')->first();

        if ($user1 && $book1) {
            Loan::create([
                'user_id' => $user1->id,
                'book_id' => $book1->id,
                'pinjam_at' => now()->subDays(5),
                'balik_at' => now()->addDays(2),
            ]);
        }

        if ($user2 && $book2) {
            Loan::create([
                'user_id' => $user2->id,
                'book_id' => $book2->id,
                'pinjam_at' => now()->subDays(10),
                'balik_at' => now()->subDays(2), // Overdue
            ]);
        }

        // Create sample purchases
        $premiumBook1 = Book::where('title', 'Machine Learning untuk Pemula')->first();
        $premiumBook2 = Book::where('title', 'Kisah Sukses Startup Indonesia')->first();

        if ($user1 && $premiumBook1) {
            BookPurchase::create([
                'user_id' => $user1->id,
                'book_id' => $premiumBook1->id,
                'amount_paid' => $premiumBook1->price,
                'purchase_date' => now()->subDays(15),
                'payment_method' => 'balance',
                'transaction_id' => 'TXN' . time() . '001',
            ]);
        }

        if ($user2 && $premiumBook2) {
            BookPurchase::create([
                'user_id' => $user2->id,
                'book_id' => $premiumBook2->id,
                'amount_paid' => $premiumBook2->price,
                'purchase_date' => now()->subDays(7),
                'payment_method' => 'balance',
                'transaction_id' => 'TXN' . time() . '002',
            ]);
        }

        $this->command->info('eLibrary sample data has been seeded successfully!');
    }
}
