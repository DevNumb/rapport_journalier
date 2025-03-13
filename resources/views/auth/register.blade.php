<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        /* Form Container */
        .form-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: 20px;
        }

        .form-container h2 {
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            color: #333;
            text-align: center;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            color: #333;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #6c757d;
            outline: none;
            box-shadow: 0 0 5px rgba(108, 117, 125, 0.5);
        }

        /* Button Styles */
        .form-group button {
            width: 100%;
            padding: 0.75rem;
            background-color: #28a745; /* Green color */
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        /* Error Messages */
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Footer Styles */
        footer {
            margin-top: 2rem;
            text-align: center;
            color: #6c757d;
            font-size: 0.875rem;
        }

        footer a {
            color: #28a745;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #218838;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <!-- Role -->
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="worker">Worker</option>
                    <option value="admin">Admin</option>
                </select>
                @error('role')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Poste -->
            <div class="form-group">
                <label for="poste">Poste</label>
                <input id="poste" type="text" name="poste" value="{{ old('poste') }}" required>
                @error('poste')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2025 Gerep-Enviroment. All rights reserved.
    </footer>
</body>
</html>
