<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            overflow-x: hidden;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            background: #111;
            color: white;
            padding-top: 20px;
            transition: all 0.3s;
        }

        .sidebar a {
            color: #bbb;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #222;
            color: white;
        }

        .sidebar.collapsed {
            margin-left: -240px;
        }

        .content {
            margin-left: 240px;
            padding: 30px;
            transition: 0.3s;
        }

        .content.full {
            margin-left: 0;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .card h3 {
            font-weight: bold;
        }

        .header {
            background: white;
            padding: 15px 30px;
            border-bottom: 1px solid #ddd;
            margin-left: 240px;
            transition: 0.3s;
        }

        .header.full {
            margin-left: 0;
        }

        .toggle-btn {
            cursor: pointer;
            font-size: 22px;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -240px;
            }

            .content,
            .header {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="sidebar" id="sidebar">
        <h4 class="text-center mb-4">My Admin</h4>
        <a href="#">Dashboard</a>
        <a href="#">Orders</a>
        <a href="#">Users</a>
        <a href="{{ route('categories.index') }}">Categories</a>
        <a href="{{ route('products.index') }}">Products</a>
        <a href="#">Settings</a>
        <form method="POST" action="{{ route('users.logout') }}" class="m-0">
            @csrf
            <a href="#"
            class="text-danger"
            onclick="event.preventDefault(); this.closest('form').submit();">
                Logout
            </a>
        </form>
    </div>

    <div class="header d-flex justify-content-between align-items-center" id="header">
        <span class="toggle-btn" onclick="toggleSidebar()">☰</span>
        <div>Welcome back, Admin</div>
    </div>

    <div class='content' id='content'>
        @yield('content')
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("content").classList.toggle("full");
            document.getElementById("header").classList.toggle("full");
        }
    </script>

    @include('layouts.footer')
</body>
</html>
