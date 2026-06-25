<footer class="bg-gradient-to-b from-[#0a0f1c] to-[#0d121e] text-gray-300 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            {{-- Brand --}}
            <div class="text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-1.5 mb-0.5">
                    <img src="{{ asset('images/cartzen_logo.PNG') }}" alt="CartZen Logo" class="h-6 w-auto object-contain">
                    <span class="text-white font-semibold text-base">CartZen</span>
                </div>
                <p class="text-[11px] text-gray-400 max-w-xs leading-tight">
                    Your one-stop online shop in Nepal.
                </p>
            </div>

            {{-- Essential Links --}}
            <div class="flex flex-wrap justify-center gap-x-5 gap-y-1 text-[11px] text-gray-400">
                <a href="#" class="hover:text-purple-400 transition-colors">Help Center</a>
                <a href="#" class="hover:text-purple-400 transition-colors">Returns</a>
                <a href="#" class="hover:text-purple-400 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-purple-400 transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-purple-400 transition-colors">Contact Us</a>
            </div>

            {{-- Social Icons --}}
            <div class="flex gap-2.5 text-sm">
                <a href="#" class="text-gray-400 hover:text-purple-400 transition-colors" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-purple-400 transition-colors" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-purple-400 transition-colors" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-purple-400 transition-colors" aria-label="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-gray-800 mt-3 pt-3 text-center text-[10px] text-gray-500">
            <p>&copy; {{ date('Y') }} CartZen Nepal. All rights reserved.</p>
        </div>
    </div>
</footer>