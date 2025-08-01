<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->boolean('is_premium')->default(false)->after('pdf_file');
            $table->decimal('price', 10, 2)->default(0.00)->after('is_premium');
            $table->string('category')->nullable()->after('price');
            $table->string('isbn')->nullable()->after('category');
            $table->integer('published_year')->nullable()->after('isbn');
            $table->integer('pages')->nullable()->after('published_year');
            $table->string('language')->default('Indonesian')->after('pages');
            $table->string('cover_image')->nullable()->after('language');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'is_premium',
                'price',
                'category',
                'isbn',
                'published_year',
                'pages',
                'language',
                'cover_image'
            ]);
        });
    }
};
