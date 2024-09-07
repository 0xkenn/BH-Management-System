<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boarding House Listings</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .navbar {
            margin-bottom: 1rem;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-bottom: 1rem;
            height: 100%;
        }
        .card-img-top {
            width: 100%;
            height: 200px; /* Fixed height */
            object-fit: cover;
        }
        .card-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        .card-text {
            font-size: 0.875rem;
            color: #666;
            margin-bottom: 1rem;
        }
        .btn-primary-card {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            text-align: center;
            display: inline-block;
            font-size: 0.875rem;
        }
        .btn-primary-card:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">BoardingHouseMS</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('welcome') }}" class="btn btn-primary">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row">
            @foreach($boardingHouses as $house)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $house->background_image) }}" class="card-img-top" alt="{{ $house->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $house->name }}</h5>
                            <p class="card-text">{{ Str::limit($house->address, 80) }}</p>
                            <a href="#" class="btn btn-primary-card">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
