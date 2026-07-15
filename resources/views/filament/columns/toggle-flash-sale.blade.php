@php
    $flashSale = $getRecord()->flashSale;
    $isActive = $getRecord()->is_flash_sale_active;
    $hasFlash = $flashSale !== null;
@endphp

<div class="flex justify-center">
    @if($hasFlash)
        <button
            wire:click="toggleFlashSale({{ $getRecord()->id }})"
            class="px-3 py-1 rounded-full text-xs font-semibold transition duration-150 ease-in-out
                {{ $isActive ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
            title="{{ $isActive ? 'Deactivate' : 'Activate' }}"
        >
            {{ $isActive ? '✓ Active' : '✗ Inactive' }}
        </button>
    @else
        <span class="text-xs text-gray-400">No sale</span>
    @endif
</div>