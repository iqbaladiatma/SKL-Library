@extends('layouts.app')

@section('title', 'Baca Buku - ' . $book->title)

@section('content')
<div id="reader-root" class="min-h-screen bg-white dark:bg-gradient-to-b dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
  <!-- Progress Bar -->
  <div id="progressBar" class="fixed top-0 left-0 h-1 bg-emerald-400 z-50 transition-all duration-200" style="width:0%"></div>

  <!-- Header -->
  <div class="sticky top-0 z-40 bg-white/80 dark:bg-gray-900/80 backdrop-blur border-b border-emerald-800 dark:border-gray-800 shadow-lg">
    <div class="max-w-4xl mx-auto px-4 py-4 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="text-emerald-300 hover:text-emerald-400 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
        </a>
        <div>
          <h1 class="text-2xl font-bold text-emerald-900 dark:text-white drop-shadow">{{ $book->title }}</h1>
          <p class="text-emerald-600 dark:text-emerald-200 text-sm">Oleh {{ $book->author }}</p>
        </div>
      </div>
      <button onclick="toggleTheme()" class="bg-emerald-500/90 text-white p-2 rounded-lg hover:bg-emerald-600 transition-colors" title="Toggle Dark/Light Mode">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="themeIcon">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
        </svg>
      </button>
    </div>
  </div>

  <!-- Main Reading Area -->
  <div class="max-w-4xl mx-auto px-4 py-8 flex flex-col md:flex-row gap-8">
    <!-- Sidebar (TOC) -->
    <nav id="toc" class="hidden md:block w-1/4 pr-4 sticky top-24 self-start">
      <h2 class="text-emerald-300 font-semibold mb-2">Navigasi</h2>
      <ul class="space-y-2 text-sm" id="tocList"></ul>
    </nav>
    <!-- Content -->
    <div class="flex-1 bg-white/80 dark:bg-gray-900/80 rounded-2xl shadow-2xl p-8 prose prose-lg max-w-none dark:prose-invert book-content border border-emerald-900/10 dark:border-gray-800/40" style="font-family: 'Merriweather', 'Georgia', serif;">
      @if($book->content)
      {!! $book->content !!}
      @else
      <div class="text-center py-12">
        <svg class="w-16 h-16 text-emerald-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
        </svg>
        <h3 class="text-xl font-semibold text-emerald-600 dark:text-emerald-300 mb-2">Konten Belum Tersedia</h3>
        <p class="text-emerald-500 dark:text-emerald-200">Konten buku ini belum tersedia untuk dibaca.</p>
      </div>
      @endif
    </div>
  </div>
</div>

<script>
  // Progress Bar
  window.addEventListener('scroll', function() {
    const docHeight = document.body.scrollHeight - window.innerHeight;
    const scrollTop = window.scrollY;
    const progress = Math.max(0, Math.min(1, scrollTop / docHeight));
    document.getElementById('progressBar').style.width = (progress * 100) + '%';
  });

  // Theme Toggle
  let isDarkTheme = false; // Default: light mode
  function toggleTheme() {
    isDarkTheme = !isDarkTheme;
    document.documentElement.classList.toggle('dark', isDarkTheme);
  }

  // Table of Contents (TOC) Generator
  function generateTOC() {
    const content = document.querySelector('.book-content');
    const tocList = document.getElementById('tocList');
    if (!content || !tocList) return;
    tocList.innerHTML = '';
    const headings = content.querySelectorAll('h1, h2, h3');
    headings.forEach((heading, idx) => {
      const id = 'heading-' + idx;
      heading.id = id;
      const li = document.createElement('li');
      li.innerHTML = `<a href="#${id}" class="hover:underline text-emerald-700 dark:text-emerald-300">${heading.innerText}</a>`;
      tocList.appendChild(li);
    });
    if (headings.length > 0) {
      document.getElementById('toc').classList.remove('hidden');
    }
  }
  document.addEventListener('DOMContentLoaded', generateTOC);
</script>

<style>
  .book-content {
    font-size: 1.15rem;
    line-height: 1.8;
    letter-spacing: 0.01em;
    font-family: 'Merriweather', 'Georgia', serif;
    color: #222;
    background: transparent;
    transition: background 0.3s, color 0.3s;
  }

  .dark .book-content {
    color: #e0f2f1;
    background: transparent;
  }

  .book-content p {
    margin-bottom: 1.5rem;
  }

  .book-content h1,
  .book-content h2,
  .book-content h3 {
    color: #10b981;
    margin-top: 2.5rem;
    margin-bottom: 1.2rem;
    font-weight: bold;
  }

  #progressBar {
    transition: width 0.2s;
  }
</style>
@endsection