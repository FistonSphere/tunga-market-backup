@extends('layouts.app')

@section('content')
    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 2s infinite ease-in-out;
        }
    </style>
    <section class="relative py-20 bg-gradient-to-b from-orange-50 via-white to-gray-50 overflow-hidden">
        <!-- Decorative background shapes -->
        <div class="absolute top-0 left-0 w-60 h-60 bg-orange-200 rounded-full blur-3xl opacity-30 -z-10"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-blue-200 rounded-full blur-3xl opacity-30 -z-10"></div>

        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="text-center mb-12">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 rounded-full shadow-md mb-4 animate-bounce-slow">
                    <span class="text-3xl">📄</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">Terms & Conditions</h1>
                <p class="text-gray-500 mt-3 text-sm">Last Updated: {{ now()->format('F d, Y') }}</p>
                <p class="mt-4 text-lg text-gray-700 max-w-3xl mx-auto">
                    Welcome to <strong class="text-orange-600">Tunga Market</strong>.
                    This page explains how and why we use cookies to provide a better, faster, and safer shopping
                    experience.
                </p>
            </div>





            <div class="mt-12 text-center text-sm text-gray-500">
                © {{ date('Y') }} <strong>Tunga Market</strong> • All Rights Reserved.
            </div>
        </div>


    </section>
@endsection
