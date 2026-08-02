@extends('layouts.app')

@section('title', 'Reset Password')
@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-xl p-8">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-8">Reset Password</h2>

            <form class="space-y-6" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input
                    type="hidden"
                    name="token"
                    value="{{ request()->route('token') }}">

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ request()->email }}"
                        required class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 sm:text-sm transition">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input
                        type="password"
                        name="password"
                        required class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 sm:text-sm transition"
                        placeholder="Enter new password">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 sm:text-sm transition"
                        placeholder="Confirm new password">
                </div>
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection