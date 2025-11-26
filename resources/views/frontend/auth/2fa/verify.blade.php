@extends('layouts.app')

@section('content')
    <div class="container max-w-md mx-auto mt-12">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold mb-3">Two-step verification</h2>
            <p class="text-sm text-gray-700 mb-4">Enter your authenticator code or a recovery code.</p>

            <form method="POST" action="{{ route('2fa.verify') }}">
                @csrf
                <div class="mb-3">
                    <label>Authenticator code (6-digits)</label>
                    <input type="text" name="one_time_code" class="input-field" maxlength="6">
                    @error('one_time_code') <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label>— or —</label>
                    <input type="text" name="recovery_code" class="input-field" placeholder="Recovery code">
                    @error('recovery_code') <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary">Verify</button>
            </form>
        </div>
    </div>
@endsection