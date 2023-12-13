<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styleregister.css') }}">

    <title>Register</title>
</head>
<body>
   
    <div class="register-container">
       
            

        <form action="{{ route('addUser') }}" method="POST">
            @csrf  
            <h2>Register</h2>
            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            
            <button type="submit">Register</button>
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif(session()->has('fail'))
                <div class="alert alert-danger">
                    {{ session('fail') }}
                </div>
            @endif
        </form>
        <p>Already have an account? <a href="{{ 'signUp' }}">Sign Up</a></p>
    </div>
</body>
</html>
