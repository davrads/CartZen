@extends('layouts.app')

@section('title','Application Submitted')

@section('content')

<div class="max-w-2xl mx-auto py-24 text-center">

    <i class="fa-solid fa-circle-check text-7xl text-green-500"></i>

    <h1 class="text-4xl font-bold mt-6">
        Application Submitted
    </h1>

    <p class="mt-5 text-gray-600">

        Thank you for applying to become a CartZen seller.

        Our team will review your application within 24–48 hours.

        You'll receive an email once your application has been reviewed.

    </p>

    <a href="{{ route('home') }}"
       class="mt-8 inline-block bg-purple-600 text-white px-6 py-3 rounded-lg">

        Return Home

    </a>

</div>

@endsection