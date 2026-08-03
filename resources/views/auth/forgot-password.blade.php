@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Forgot Password?</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Enter your email address and we'll send you a link to reset your password.
                </p>
            </div>

            @if(session('status'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email Address
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 sm:text-sm transition"
                        placeholder="you@example.com"
                    >
                    
                    @error('email')
                        <p class="text-red-600 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <button 
                        type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition"
                    >
                        Send Reset Link
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a 
                    href="{{ route('login') }}" 
                    class="text-sm text-gray-600 hover:text-gray-900 font-medium transition"
                >
                    &larr; Back to Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection