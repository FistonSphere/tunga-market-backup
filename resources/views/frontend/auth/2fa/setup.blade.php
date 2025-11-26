@extends('layouts.app')

@section('content')
<div class="container max-w-xl mx-auto mt-8">
    <h2 class="text-xl font-semibold mb-4">Enable Two-Factor Authentication</h2>

    <p class="mb-3">Scan the QR code with Google Authenticator, Authy, or similar app. Then enter the 6-digit code below to confirm.</p>

    <div class="flex gap-6">
        <div>
            <img src="{{ $qrCodeUrl }}" alt="QR Code for 2FA">
        </div>
        <div>
            <p><strong>Secret key:</strong> <code>{{ $secret }}</code></p>
            <p class="text-sm text-gray-600">If your phone cannot scan the QR, enter the secret into your authenticator app manually.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('2fa.confirm') }}" class="mt-6">
        @csrf
        <div class="mb-3">
            <label>One-time code from app</label>
            <input type="text" name="one_time_code" class="input-field" maxlength="6" required>
            @error('one_time_code') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Your password (for verification)</label>
            <input type="password" name="password" class="input-field" required>
            @error('password') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary">Enable 2FA</button>
    </form>
</div>
@endsection
