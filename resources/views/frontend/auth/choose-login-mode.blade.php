<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Choose Login Mode</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        /* Dark gradient overlay */
        .overlay {
            position: fixed;
            inset: 0;
            background: linear-gradient(to bottom right,
                    rgba(0, 0, 0, 0.9),
                    rgba(0, 0, 0, 0.6));
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 50;
            animation: fadeIn .4s ease-out;
        }

        /* Popup card */
        .modal-box {
            width: 420px;
            background: #ffffff;
            padding: 30px;
            border-radius: 18px;
            text-align: center;
            animation: popUp .35s ease-out;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes popUp {
            from {
                transform: scale(0.7);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px 0;
            margin-top: 12px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: #ff7d3d;
            color: white;
        }

        .btn-secondary {
            background-color: #e5e7eb;
            color: #333;
        }
    </style>

</head>

<body>

    <div class="overlay">
        <div class="modal-box">
            <h2 style="margin-bottom:10px; color:#ff7d3d;">Admin Detected</h2>

            <p style="font-size:16px; color:#555;">
                Hi <strong>{{ Auth::user()->first_name }}</strong>,
                you seem like an administrator.<br><br>
                Would you like to continue to the <strong>Admin Portal</strong>?
            </p>

            <button class="btn btn-primary" onclick="goAdmin()">Yes, go to Admin Portal</button>
            <button class="btn btn-secondary" onclick="goNormal()">No, continue as normal user</button>
        </div>
    </div>

    <script>
        function goAdmin() {
            window.location.href = "/account/admin/login";
        }

        function goNormal() {
            window.location.href = "/";
        }
    </script>

</body>

</html>