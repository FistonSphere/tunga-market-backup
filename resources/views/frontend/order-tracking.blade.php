@extends('layouts.app')
@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-primary-50 to-accent-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-primary mb-4">Order Tracking Center</h1>
                <p class="text-lg text-secondary-600 max-w-2xl mx-auto">
                    Track your orders with real-time updates, manage delivery preferences, and access order history
                </p>
            </div>
        </div>
    </section>

     <!-- Main Tracking Interface -->
 <section class="py-8">
     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
         <div class="grid lg:grid-cols-2 gap-8">
             <!-- Left Panel - Order History Table -->
             <div class="space-y-6">
                 <!-- Filters and Search -->
                 <div class="card">
                     <h3 class="text-xl font-semibold text-primary mb-4">Order History</h3>
                     
@endsection
