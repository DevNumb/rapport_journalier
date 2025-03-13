<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GEREP-enviroment</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            margin: 0; /* Remove default margin */
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start; /* Align items at the top */
            min-height: 100vh;
            position: relative; /* For footer positioning */
            padding-top: 2rem; /* Add some padding at the top */
        }

        .login-form-container {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 28rem;
            margin-bottom: 3rem; /* Space between form and footer */
        }

        .login-form {
            width: 100%;
        }

        .form-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1a1a1a;
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-form input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            color: #1a1a1a;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .login-form input:focus {
            border-color: #10b981; /* Green focus border */
            outline: none;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); /* Green focus shadow */
        }

        .login-form button {
            background-color: #10b981; /* Green button */
            color: #ffffff;
            font-weight: 500;
            padding: 0.75rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }

        .login-form button:hover {
            background-color: #059669; /* Darker green on hover */
        }

        .login-form a {
            color: #10b981; /* Green link */
            text-decoration: none;
            transition: color 0.2s;
        }

        .login-form a:hover {
            color: #059669; /* Darker green on hover */
        }

        .footer {
            position: fixed; /* Keep the footer at the bottom */
            bottom: 0;
            width: 100%;
            text-align: center;
            color: #6b7280;
            font-size: 0.875rem;
            background-color: #f9fafb; /* Match background color */
            padding: 1rem;
        }

        /* Center the login button */
        .submit-button-container {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="form-title">Rapport Journalier</h1>

        <div class="login-form-container">

            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="submit-button-container">
                <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 font-bold font-sans text-lg">
    Log in
</button>

                </div>
            </form>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; {{ date('Y') }} GEREP-enviroment. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
