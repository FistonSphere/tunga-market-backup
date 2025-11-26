@extends('layouts.app')

@section('content')
    <div class="container max-w-xl mx-auto mt-8">
        <h2 class="text-xl font-semibold mb-4">Two-Factor Authentication</h2>

        @if(session('success'))
        <div class="text-green-600">{{ session('success') }}</div> @endif

        <div class="mb-4">
            <p>Status: <strong>{{ $user->two_factor_enabled ? 'Enabled' : 'Disabled' }}</strong></p>
        </div>

        @if($user->two_factor_enabled)
                <h3 class="font-medium">Recovery Codes</h3>
                <p class="text-sm text-gray-600 mb-3">Store these codes somewhere safe. Each code can be used once.</p>

                <pre class="p-4 bg-gray-50 border rounded mb-3">
            @foreach ($user->recoveryCodes as $c)
                {{ $c }}
            @endforeach
                    </pre>

                <form method="POST" action="{{ route('2fa.regenerate') }}">
                    @csrf
                    <div class="mb-2">
                        <label>Confirm password to regenerate</label>
                        <input type="password" name="password" class="input-field" required>
                    </div>
                    <button class="btn btn-secondary">Regenerate Recovery Codes</button>
                </form>

                <hr class="my-4">

                <form method="POST" action="{{ route('2fa.disable') }}">
                    @csrf
                    <div class="mb-2">
                        <label>Enter one-time TOTP code or a recovery code</label>
                        <input type="text" name="code" class="input-field" required>
                    </div>
                    <div class="mb-2">
                        <label>Confirm password</label>
                        <input type="password" name="password" class="input-field" required>
                    </div>
                    <button class="btn btn-primary">Disable Two-Factor Authentication</button>
                </form>
        @else
            <p>Two-factor is not active. <a href="{{ route('2fa.setup') }}" class="text-blue-600 underline">Set up now</a>.</p>
        @endif
    </div>
@endsection