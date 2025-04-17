<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .login-container .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container .header img {
            max-width: 60px;
            margin-bottom: 10px;
        }

        .login-container .header h2 {
            font-size: 24px;
            margin: 0;
            color: #333;
        }

        .login-container .header p {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        .login-container .form-group {
            margin-bottom: 15px;
        }

        .login-container .form-group label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .login-container .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .login-container .form-group input:focus {
            border-color: #007BFF;
            outline: none;
        }

        .login-container .form-group .remember-me {
            display: flex;
            align-items: center;
        }

        .login-container .form-group .remember-me input {
            width: auto;
            margin-right: 10px;
        }

        .login-container .form-group .remember-me label {
            margin: 0;
            font-size: 14px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .login-container .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .login-container .forgot-password a {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
        }

        .login-container .forgot-password a:hover {
            text-decoration: underline;
        }

        /* Error message styling */
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="header">
            <img src="/assets/icon/logoppu.png" alt="E-Sarpras Logo">
            <h2>Welcome Back!</h2>
            <p>Sign in to continue to E-Sarpras.</p>
        </div>

        <!-- Display error message if any -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message"><?= session()->getFlashdata('error') ?></div>
        <?php endif ?>

        <!-- Login Form -->
        <form action="/login" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="npsn">NPSN</label>
                <input type="text" id="npsn" name="npsn" placeholder="Enter NPSN" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="form-group remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>
            <button type="submit">Log In</button>
        </form>

        <!-- Forgot Password Link -->
        <div class="forgot-password">
            <a href="#">Forgot your password?</a>
        </div>

        <!-- New "Kembali ke Home" button -->
        <div class="back-to-home">
            <a href="/">Kembali ke Home</a>
        </div>
    </div>
</body>

</html>