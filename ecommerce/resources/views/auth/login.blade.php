<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/auth/styles.css" />
</head>


<body>
    <div class="container">
        <h2>Login</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>

    <p>Don't have an account? <a href="{{ route('register') }}">register</a></p>
</body>
</html>
