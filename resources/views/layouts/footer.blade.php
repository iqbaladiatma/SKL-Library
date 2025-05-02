<footer class="bg-gray-900 text-gray-300 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">About eLibrary</h4>
                <p class="text-sm">
                    eLibrary is your digital gateway to thousands of books and resources, designed to make reading accessible and enjoyable.
                </p>
            </div>

            <!-- Navigation -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Navigation</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition">About</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Contact Us</h4>
                <ul class="space-y-2 text-sm">
                    <li>123 Library Street, Book City, BC 12345</li>
                    <li>(123) 456-7890</li>
                    <li>contact@elibrary.com</li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-8 pt-8 border-t border-gray-700 text-center text-sm">
            <p>&copy; {{ date('Y') }} eLibrary. All rights reserved.</p>
        </div>
    </div>
</footer>