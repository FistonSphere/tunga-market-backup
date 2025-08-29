@extends('layouts.app')

@section('title', $category->name)

@section('content')
   <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-primary font-medium">{{ $category->name }}</span>
    </nav>
     <!-- Category Title -->
    <h1 class="text-2xl font-bold text-primary mb-6">{{ $category->name }}</h1>
@endsection