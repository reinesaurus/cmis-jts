<!DOCTYPE html>
<html>
<head>
    <title>Customer</title>
    <link rel="stylesheet" href="{{ asset('css/customer/customer.css') }}">
</head>

<body>

<div class="customer-app">

    <!-- HEADER -->
    <div class="header">
        <div class="logo">
            <div class="logo-box"></div>
            PT. JTS Membership
        </div>

        <div>🔔</div>
    </div>


    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>


    <!-- BOTTOM MENU -->
    <div class="bottom-nav">

        <a href="/customer/home" class="nav-item">
            🏠
            <span>Home</span>
        </a>

        <a href="/customer/rewards" class="nav-item">
            🎖
            <span>Reward</span>
        </a>

        <a href="/customer/redeem" class="nav-item">
            🎁
            <span>Redeem</span>
        </a>

        <a href="/customer/profile" class="nav-item">
            👤
            <span>Profile</span>
        </a>

    </div>

</div>

</body>
</html>