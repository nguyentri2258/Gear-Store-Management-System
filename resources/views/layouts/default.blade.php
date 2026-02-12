<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>Gear Store</title>
    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 24px;
        }

        .product-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            transition: 0.25s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
        }

        .product-image {
            height: 160px;
            background: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            font-size: 14px;
        }

        .product-body {
            padding: 16px;
        }

        .product-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 14px;
            text-align: center;
        }

        .product-actions {
            display: grid;
            gap: 8px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')
</body>
</html>
