@php
    $gs = \App\Models\GeneralSetting::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify OTP - {{$gs->site_name}}</title>
</head>

<body>
    <div id="otp-overlay" style="
  position: fixed; inset: 0;
  display: flex; align-items: center; justify-content: center;
  background: rgba(0,0,0,0.6);
  backdrop-filter: blur(5px);
  z-index: 9999;
  animation: fadeIn 0.4s ease-out;
">
        <div id="otp-modal" style="
    background: #fff;
    border-radius: 20px;
    padding: 40px;
    width: 100%;
    max-width: 420px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    transform: scale(0.95);
    animation: popupIn 0.4s ease-out forwards;
  ">
            <h2 style="font-size: 26px; font-weight: 700; color: #ff6b00; margin-bottom: 10px;">
                Verify One-Time Password
            </h2>
            <p style="color: #6b7280; font-size: 15px; margin-bottom: 25px;">
                Enter or paste the 6-digit verification code we sent to your email.
            </p>

            <!-- Alerts -->
            @if ($errors->any())
                <div
                    style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div
                    style="background: #dcfce7; color: #15803d; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- OTP FORM -->
            <form id="otp-form" action="{{ route('password.verify.otp') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <div style="display: flex; justify-content: space-between; margin-bottom: 25px;">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" maxlength="1" name="otp[]" class="otp-input" required />
                    @endfor
                </div>

                <button type="submit" id="verify-btn" style="
        width: 100%;
        background: #0c2d57;
        color: white;
        border: none;
        padding: 12px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
      " onmouseover="this.style.background='#ff6b00'; this.style.transform='scale(1.02)';"
                    onmouseout="this.style.background='#0c2d57'; this.style.transform='scale(1)';">
                    Verify Code
                </button>

                <p style="margin-top: 20px; font-size: 14px; color: #6b7280;">
                    Didn’t receive the code?
                    <button type="button" id="resend-btn" style="
          background: none;
          border: none;
          color: #ff6b00;
          font-weight: 600;
          cursor: pointer;
          text-decoration: underline;
        " disabled>Resend in <span id="timer">30</span>s</button>
                </p>
            </form>
        </div>

        <!-- SUCCESS MODAL -->
        <div id="success-modal" style="
    display: none;
    text-align: center;
    background: #fff;
    border-radius: 20px;
    padding: 40px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    animation: popupIn 0.4s ease-out;
  ">
            <div style="margin-bottom: 20px;">
                <svg style="width: 80px; height: 80px; color: #22c55e; margin: 0 auto;" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke-width="2" stroke="#22c55e" fill="none"></circle>
                    <path d="M8 12l3 3 5-5" stroke="#22c55e" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <animate attributeName="stroke-dasharray" from="0,20" to="20,0" dur="0.6s" fill="freeze" />
                    </path>
                </svg>
            </div>
            <h3 style="color: #16a34a; font-size: 22px; font-weight: 700; margin-bottom: 10px;">Verification Successful!
            </h3>
            <p style="color: #6b7280; font-size: 15px;">Redirecting you to reset password page...</p>
        </div>
    </div>

    <style>
        * {
            font-family: Inter, sans-serif;
        }

        .otp-input {
            width: 45px;
            height: 50px;
            border: 2px solid #d1d5db;
            border-radius: 10px;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            color: #0c2d57;
            transition: all 0.2s ease;
        }

        .otp-input:focus {
            border-color: #0c2d57;
            outline: none;
            box-shadow: 0 0 8px rgba(37, 99, 235, 0.4);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes popupIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

    <script>
        const inputs = document.querySelectorAll(".otp-input");
        const form = document.getElementById("otp-form");
        const successModal = document.getElementById("success-modal");
        const otpModal = document.getElementById("otp-modal");
        const resendBtn = document.getElementById("resend-btn");
        const timerElement = document.getElementById("timer");

        // Auto move and backspace navigation
        inputs.forEach((input, i) => {
            input.addEventListener("input", e => {
                if (input.value.length === 1 && i < inputs.length - 1) inputs[i + 1].focus();
            });
            input.addEventListener("keydown", e => {
                if (e.key === "Backspace" && !input.value && i > 0) inputs[i - 1].focus();
            });
        });

        // Paste handling
        form.addEventListener("paste", e => {
            e.preventDefault();
            const pasteData = e.clipboardData.getData("text").trim();
            if (/^\d{6}$/.test(pasteData)) {
                pasteData.split("").forEach((num, idx) => {
                    if (inputs[idx]) inputs[idx].value = num;
                });
                inputs[5].focus();
            }
        });

        // Countdown for resend button
        let timeLeft = 30;
        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(countdown);
                resendBtn.disabled = false;
                resendBtn.textContent = "Resend OTP";
            }
        }, 1000);

        // Resend OTP using Laravel route
        resendBtn.addEventListener("click", async () => {
            resendBtn.disabled = true;
            resendBtn.textContent = "Sending...";

            try {
                const response = await fetch("{{ route('password.email') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        email: "{{ session('reset_email') }}"
                    })
                });

                const data = await response.text();

                resendBtn.textContent = "Resend in 30s";
                let t = 30;
                const newTimer = setInterval(() => {
                    t--;
                    if (t <= 0) {
                        clearInterval(newTimer);
                        resendBtn.disabled = false;
                        resendBtn.textContent = "Resend OTP";
                    } else {
                        resendBtn.textContent = `Resend in ${t}s`;
                    }
                }, 1000);
            } catch (error) {
                alert("Error resending OTP. Try again later.");
                resendBtn.disabled = false;
                resendBtn.textContent = "Resend OTP";
            }
        });

        // Success modal before redirect
        form.addEventListener("submit", e => {
            e.preventDefault();
            otpModal.style.display = "none";
            successModal.style.display = "block";

            setTimeout(() => {
                window.location.href = "{{ route('password.reset') }}";
            }, 2500);
        });
    </script>
</body>


</html>