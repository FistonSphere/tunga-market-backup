<div class="fixed inset-0 flex items-center justify-center bg-black/60">
    <div class="bg-white rounded-2xl p-8 max-w-md w-full text-center shadow-xl">
        <h2 class="text-2xl font-bold mb-4 text-primary">Verify OTP</h2>
        <p class="text-gray-500 mb-6">Enter the 6-digit code sent to your email.</p>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded mb-3 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 text-green-700 p-3 rounded mb-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('password.verify.otp') }}" method="POST">
            @csrf
            <input type="text" name="otp" maxlength="6" required
                class="w-full text-center text-xl tracking-widest border border-gray-300 rounded-lg py-3 focus:ring focus:ring-primary/40 mb-4" />

            <button type="submit"
                class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-primary/90 transition-all">
                Verify Code
            </button>
        </form>
    </div>
</div>
