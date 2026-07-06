@extends('layouts.app')

@section('content')
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: #F4F3F8;
        }

        .mono {
            font-family: 'DM Mono', monospace;
        }

        .pay-card {
            cursor: pointer;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .pay-card:has(input:checked) {
            border-color: #7C3AED;
            background: #FAF8FF;
            box-shadow: 0 0 0 3px #EDE9FE;
        }

        .pay-card input[type=radio] {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #D1D5DB;
            border-radius: 50%;
            transition: .2s;
            flex-shrink: 0;
        }

        .pay-card:has(input:checked) input[type=radio] {
            border-color: #7C3AED;
            background: #7C3AED;
            box-shadow: inset 0 0 0 3px white;
        }

        .prod-img {
            background: linear-gradient(135deg, #f3f0ff 0%, #e9e4fa 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .store-row summary {
            list-style: none;
        }

        .store-row summary::-webkit-details-marker {
            display: none;
        }

        .store-row[open] .chev {
            transform: rotate(180deg);
        }

        .chev {
            transition: transform .25s;
        }

        .place-btn {
            background: linear-gradient(90deg, #7C3AED 0%, #9333EA 50%, #7C3AED 100%);
            background-size: 200% auto;
            transition: background-position .4s, box-shadow .2s;
        }

        .place-btn:hover {
            background-position: right center;
            box-shadow: 0 8px 24px #7c3aed44;
        }

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 4px;
        }

        @keyframes up {
            from {
                opacity: 0;
                transform: translateY(16px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        .card {
            animation: up .4s ease both;
        }

        .card:nth-child(2) {
            animation-delay: .07s
        }

        .card:nth-child(3) {
            animation-delay: .14s
        }

        .addr-card {
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }

        .addr-card:has(input:checked) {
            border-color: #7C3AED;
            background: #FAF8FF;
            box-shadow: 0 0 0 3px #EDE9FE;
        }

        .addr-card input[type=radio] {
            appearance: none;
            width: 16px;
            height: 16px;
            border: 2px solid #D1D5DB;
            border-radius: 50%;
            transition: .2s;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .addr-card:has(input:checked) input[type=radio] {
            border-color: #7C3AED;
            background: #7C3AED;
            box-shadow: inset 0 0 0 3px white;
        }
    </style>

    <form action="{{ route('place.order') }}" method="POST" id="checkoutForm">
        @csrf

        <div class="py-6 px-3 sm:px-6 lg:px-10">
            <div class="max-w-5xl mx-auto flex items-center gap-1.5 text-xs text-gray-400 mb-6 font-medium">
                <span class="text-violet-500">Cart</span>
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
                <span class="text-violet-500">Checkout</span>
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
                <span class="text-gray-800">Confirmation</span>
            </div>

            @if (session('error'))
                <div
                    class="max-w-5xl mx-auto mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative text-sm font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="max-w-5xl mx-auto mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative text-sm font-semibold">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-5">

                <div class="space-y-5">
                    <div class="card bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-violet-100 rounded-lg flex items-center justify-center">
                                    <svg width="14" height="14" fill="none" stroke="#7C3AED" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                </div>
                                <h2 class="font-bold text-gray-900 text-base">Delivery Address</h2>
                            </div>
                            <a href="{{ route('profile') }}"
                                class="text-violet-600 hover:text-violet-800 text-sm font-semibold transition hover:underline underline-offset-2">Manage</a>
                        </div>

                        @if ($addresses->isEmpty())
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm text-gray-700">
                                You have no saved addresses.
                                <a href="{{ route('profile') }}" class="text-violet-600 font-semibold hover:underline">Add
                                    one now</a>.
                            </div>
                        @else
                            <div class="space-y-2.5">
                                @foreach ($addresses as $addr)
                                    <label
                                        class="addr-card flex items-start gap-3 border-2 border-gray-200 rounded-xl px-4 py-3.5 transition">
                                        <input type="radio" name="address_id" value="{{ $addr->id }}"
                                            {{ $loop->first ? 'checked' : '' }} />
                                        <div class="flex-1 min-w-0">
                                            <p class="font-bold text-gray-900 text-sm">{{ $addr->full_name }}</p>
                                            <p class="text-sm text-gray-500 mt-0.5 leading-relaxed">
                                                {{ $addr->address_line }}, {{ $addr->city }}, {{ $addr->district }},
                                                {{ $addr->province }}
                                                @if ($addr->postal_code)
                                                    - {{ $addr->postal_code }}
                                                @endif
                                            </p>
                                            <p class="mono text-xs text-gray-400 mt-1.5 tracking-wide">{{ $addr->phone }}
                                            </p>
                                        </div>
                                        @if ($loop->first)
                                            <span
                                                class="ml-auto text-xs bg-green-100 text-green-600 font-semibold px-2.5 py-1 rounded-full shrink-0">Default</span>
                                        @endif
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="card bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sm:p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-7 h-7 bg-violet-100 rounded-lg flex items-center justify-center">
                                <svg width="14" height="14" fill="none" stroke="#7C3AED" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <rect x="1" y="4" width="22" height="16" rx="2" />
                                    <line x1="1" y1="10" x2="23" y2="10" />
                                </svg>
                            </div>
                            <h2 class="font-bold text-gray-900 text-base">Payment Method</h2>
                        </div>
                        <div class="space-y-2.5">
                            <label
                                class="pay-card flex items-center gap-3.5 border-2 border-gray-200 rounded-xl px-4 py-3.5">
                                <div class="w-9 h-9 rounded-xl bg-purple-500 flex items-center justify-center shrink-0">
                                   <img src="{{ asset('images/khalti_logo.jpg') }}" alt="khalti_logo" class="w-full h-full object-contain">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-800 text-sm">Khalti</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Pay securely via Khalti</p>
                                </div>
                                <input type="radio" name="payment_method" value="khalti" checked />
                            </label>
                            <label
                                class="pay-card flex items-center gap-3.5 border-2 border-gray-200 rounded-xl px-4 py-3.5">
                                <div class="w-9 h-9 rounded-xl bg-violet-600 flex items-center justify-center shrink-0">
                                    <svg width="16" height="16" fill="none" stroke="white" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <rect x="2" y="6" width="20" height="12" rx="2" />
                                        <line x1="1" y1="10" x2="23" y2="10" />
                                    </svg>
                                    
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-800 text-sm">Cash on Delivery</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Pay when you receive</p>
                                </div>
                                <input type="radio" name="payment_method" value="cod" />
                            </label>

                            
                        </div>
                    </div>
                </div>

                <div class="card space-y-4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sm:p-6">
                        <div class="flex items-center gap-2 mb-5">
                            <div class="w-7 h-7 bg-violet-100 rounded-lg flex items-center justify-center">
                                <svg width="14" height="14" fill="none" stroke="#7C3AED" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                                    <line x1="3" y1="6" x2="21" y2="6" />
                                    <path d="M16 10a4 4 0 0 1-8 0" />
                                </svg>
                            </div>
                            <h2 class="font-bold text-gray-900 text-base">Order Summary</h2>
                        </div>

                        @if (isset($vendorsData) && count($vendorsData) > 0)
                            @foreach ($vendorsData as $index => $vendor)
                                <details class="store-row mb-3" open>
                                    <summary class="flex items-center gap-2 cursor-pointer select-none mb-3">
                                        <div class="w-2 h-2 rounded-full bg-blue-500 shrink-0"></div>
                                        <span
                                            class="text-xs font-bold text-gray-700 tracking-wide uppercase">{{ $vendor['vendor_name'] ?? 'Store' }}</span>
                                        <svg class="chev ml-auto w-4 h-4 text-gray-400" fill="none"
                                            stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <polyline points="6 9 12 15 18 9" />
                                        </svg>
                                    </summary>

                                    @foreach ($vendor['items'] as $item)
                                        <div class="flex gap-3 bg-gray-50 rounded-xl p-3 mb-2">
                                            <div
                                                class="w-20 h-20 bg-white border border-gray-100 rounded-xl flex items-center justify-center p-2 shrink-0">
                                                <img src="{{ asset('storage/' . ($item['product']['thumbnail'] ?? ($item['thumbnail'] ?? ''))) }}"
                                                    class="object-cover w-full h-full rounded-md">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-semibold text-gray-800 leading-snug">
                                                    {{ $item['product']['name'] ?? ($item['name'] ?? 'Product') }}
                                                </h4>

                                               

                                                <p class="text-xs text-gray-400 mt-0.5">Qty: {{ $item['quantity'] }}</p>
                                            </div>
                                            <div class="text-right shrink-0">
                                                <p class="mono text-sm font-bold text-gray-800">
                                                    Rs.
                                                    {{ number_format(($item['discounted_price'] ?? ($item['price'] ?? ($item['product']['price'] ?? 0))) * $item['quantity']) }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach

                                </details>
                            @endforeach
                        @else
                            <p class="text-sm text-gray-500">Your cart details are empty.</p>
                        @endif

                        <div class="border-t border-gray-100 mt-4 pt-4 space-y-2.5">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Subtotal</span>
                                <span class="mono text-sm text-gray-700 font-medium">Rs.
                                    {{ number_format($cartSubtotal ?? 0) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Delivery Fee</span>
                                <span class="mono text-sm font-bold text-green-500">Free</span>
                            </div>
                        </div>

                        <div
                            class="flex justify-between items-center bg-violet-50 border border-violet-100 rounded-xl px-4 py-3.5 mt-4">
                            <span class="font-bold text-gray-900 text-base">Total Amount</span>
                            <span class="mono font-extrabold text-violet-600 text-lg">Rs.
                                {{ number_format($cartSubtotal ?? 0) }}</span>
                        </div>

                        <button type="submit" id="placeOrderBtn"
                            class="place-btn w-full mt-4 text-white font-bold text-base py-4 rounded-xl flex items-center justify-center gap-2 tracking-wide">
                            <svg width="18" height="18" fill="none" stroke="white" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path d="M20 12V22H4V12" />
                                <path d="M22 7H2v5h20V7z" />
                                <path d="M12 22V7" />
                                <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z" />
                                <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z" />
                            </svg>
                            Place Order
                        </button>

                        <p class="text-center text-xs text-gray-400 mt-2.5">You won't be charged until your order is
                            confirmed.</p>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
