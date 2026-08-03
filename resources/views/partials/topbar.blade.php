<div class="bg-gray-900 text-white py-1.5 sm:py-2 text-[10px] sm:text-sm">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 flex flex-col sm:flex-row justify-between items-center gap-1.5 sm:gap-6">
        
        {{-- Left Side: Location & Free Delivery --}}
        <div class="flex items-center justify-center sm:justify-start gap-2 sm:gap-6 w-full sm:w-auto text-center">
            <span class="truncate">Deliver to Kathmandu, Nepal</span>
            <span class="hidden xs:inline text-gray-600">|</span>
            <span class="text-green-400 font-medium truncate">Free Delivery on Orders Over Rs. 999</span>
        </div>

        {{-- Right Side: Links --}}
        <div class="flex items-center justify-center sm:justify-end gap-2.5 sm:gap-6 w-full sm:w-auto overflow-x-auto whitespace-nowrap no-scrollbar py-0.5">
            <a href="#" class="hover:text-purple-400 transition-colors">Download App</a>
            <span class="text-gray-700 text-[9px] sm:hidden">•</span>
            <a href="{{ route('vendor.request') }}" class="hover:text-purple-400 transition-colors">Join as Seller</a>
            <span class="text-gray-700 text-[9px] sm:hidden">•</span>
            <a href="{{ route('filament.vendor.auth.login') }}" class="hover:text-purple-400 transition-colors">Sell on Cartzen</a>
            <span class="text-gray-700 text-[9px] sm:hidden">•</span>
            <a href="#" class="hover:text-purple-400 transition-colors">Help</a>
        </div>

    </div>
</div>

{{-- Scrollbar लुकाउनका लागि साना CSS Utility (वैकल्पिक) --}}
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>