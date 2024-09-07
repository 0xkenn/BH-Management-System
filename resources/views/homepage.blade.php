<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boarding House Listings</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }


        .card-img-top {
            width: 100%;
            height: 180px; /* Adjusted height */
            object-fit: cover;
        }

        .btn-primary-card {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 20px;

            font-size: 0.8rem;
            text-align: center;

            transition: background-color 0.3s;
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
                <div class="col-md-3 mb-8">
                    <div class="card">
                        <img src="{{ asset('storage/' . $house->background_image) }}" class="card-img-top" alt="{{ $house->name }}">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-house-user icon"></i>
                                {{ $house->name }}
                            </h5>
                            <p class="card-text">
                                <i class="fas fa-map-marker-alt icon"></i>
                                {{ Str::limit($house->address, 90) }}
                            </p>
                            <p class="card-text italic">{{ Str::limit($house->description, 50) }}</p>
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
