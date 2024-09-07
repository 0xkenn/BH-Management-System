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
            .card-img-top {
                width: 100%;
                height: 200px; /* Fixed height for all images */
                object-fit: cover; /* Ensures the image covers the area without distortion */
            }

            .card {
                border: none; /* Remove card border */
                border-radius: 15px; /* Rounded corners for the card */
                overflow: hidden; /* Ensures rounded corners for the image */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow effect */
            }

            .card-body {
                padding: 1.5rem; /* Increased padding for card content */
            }

            .card-title {
                font-size: 1.25rem; /* Larger font size for card titles */
                font-weight: 600; /* Bold font weight for better visibility */
            }


        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
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

        <div class="container-fluid py-5">

            <div class="row">
                @foreach($boardingHouses as $house)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <!-- Make sure the path is correct -->
                            <img src="{{ asset('storage/' . $house->background_image) }}" class="card-img-top" alt="{{ $house->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $house->name }}</h5>
                                <p class="card-text">{{ $house->address }}</p>
                                <a href="#" class="btn btn-primary">View Details</a>
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
