<!DOCTYPE html>
<html>
<head>
    <title>CMIS</title>

    <link rel="stylesheet" href="{{ asset('css/internal/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/internal/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/internal/components.css') }}">

    @stack('styles')
</head>

<body>

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="logo">
            <div class="logo-box"></div>
            CMIS - PT. Jaya Teknik Sejahtera
        </div>

        <div class="top-icons">
            <span class="notif-icon">🔔</span>

            <div class="user-menu">
                <span onclick="toggleUserMenu()">👤</span>

                <div id="userDropdown" class="user-dropdown">
                    <div class="user-info">
                        <div class="user-avatar">👤</div>

                        <strong>{{ auth()->user()->full_name }}</strong>
                        <p>{{ auth()->user()->email }}</p>

                        <p class="user-role">
                            Logged in as: {{ auth()->user()->role }}
                        </p>
                    </div>

                    <form method="POST" action="/logout">
                        @csrf
                        <button class="btn-secondary">Log out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- MAIN LAYOUT -->
    <div class="layout">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <ul>
                <li><a href="{{ route('internal.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('internal.customers') }}">Customers</a></li>
                <li><a href="{{ route('internal.transactions') }}">Transactions</a></li>
                <li><a href="{{ route('internal.rewards') }}">Rewards</a></li>
                <li><a href="{{ route('internal.redemption') }}">Redemption</a></li>
            </ul>
        </div>


        <!-- CONTENT AREA -->
        <div class="content-area">

            <!--main-->
            <div class="page-container">

                <!-- ALERT -->
                @if(session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- CONTENT -->
                @yield('content')

            </div>

        </div>

    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {

        const trigger = document.querySelector(".user-menu span");
        const dropdown = document.getElementById("userDropdown");

        trigger.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdown.classList.toggle("active");
        });

        document.addEventListener("click", function () {
            dropdown.classList.remove("active");
        });

    });
    </script>

</body>
</html>