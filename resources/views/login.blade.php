<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>CMIS - Login</title>

<link rel="stylesheet" href="{{ asset('css/global/login.css') }}">


</head>
<body>

<div class="topbar">
    <div class="topbar-left">
        <img src="{{ asset('img/logo.png') }}" class="topbar-logo">


    <div class="topbar-title">
        CMIS - PT. Jaya Teknik Sejahtera
    </div>
</div>


</div>

<div class="container">


<div class="login-card">

    <div class="login-title">
        Log in Account
    </div>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    @error('login')
        <div class="error">
            {{ $message }}
        </div>
    @enderror

    @error('password')
        <div class="error">
            {{ $message }}
        </div>
    @enderror

    <form method="POST" action="/login">

        @csrf

        <div class="form-group">
            <label>Email</label>
            <input 
                type="email" 
                name="email" 
                placeholder="Enter your email here"
                required
            >
        </div>

        <div class="form-group">
            <label>Password</label>
            <input 
                type="password" 
                name="password" 
                placeholder="Enter your password here"
                required
            >

            <div class="forgot">
                Forgot password? Click here.
            </div>
        </div>

        <button type="submit" class="login-btn">
            Log in
        </button>

    </form>

</div>


</div>

</body>
</html>
