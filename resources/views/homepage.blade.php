<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boarding House Listings</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg" style="background-color: rgb(255, 255, 255); box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <a class="navbar-brand text-dark d-flex align-items-center" href="#" style="font-weight: bold;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mb-1" style="width: 70px; height: auto; background: none; padding: 0 10px;">
            BoardingHouseMS
        </a>
        <div class="collapse navbar-collapse">
            <form class="form-inline ml-auto my-2 my-lg-0">
                <input class="form-control mr-sm-2 rounded-pill" type="search" placeholder="Search..." aria-label="Search" style="width: 500px;">
                <a href="{{ route('welcome') }}" class="btn btn-dark my-2 my-sm-0 rounded-pill" style="width: 150px;">Login</a>
            </form>
        </div>
    </nav>


    <div class="container pt-5 pb-3">
        <div class="row justify-content-center">
            @foreach($boardingHouses as $house)
                <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
                    <div class="card bg-base-100 shadow-xl" style="border-radius: 12px; width: 100%; max-width: 450px;">
                        <img src="{{ asset('storage/' . $house->background_image) }}"
                             class="card-img-top"
                             alt="{{ $house->name }}"
                             style="height: 200px; object-fit: cover; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold" style="font-size: 1.2rem; color: #333;">
                                {{ $house->name }}
                            </h5>
                            <p class="card-text" style="font-size: 0.9rem; color: #666;">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ Str::limit($house->address, 90) }}
                            </p>
                            <p class="card-text" style="color: #555; font-size: 0.85rem; text-align: justify; line-height: 1.4;">
                                {{ Str::limit($house->description, 80) }}
                            </p>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-primary rounded-pill" style="width: 100%;" data-toggle="modal" data-target="#modal{{ $house->id }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal{{ $house->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $house->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel{{ $house->id }}">{{ $house->name }} Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @foreach ($house->rooms as $room)
                                {{-- edit this make it a card --}}
                                <div class="mb-3">
                                   @if ($room->room_image_1 != null)
                                   <img src="{{ asset('storage/' . $room->room_image_1) }}" class="img-fluid" alt="{{ $room->name }}">
                                   @endif
                                    @if ($room->room_image_2 != null)
                                    <img src="{{ asset('storage/' . $room->room_image_2) }}" class="img-fluid" alt="{{ $room->name }}">
                                    @endif
                                    @if ($room->room_image_3 != null)
                                    <img src="{{ asset('storage/' . $room->room_image_3) }}" class="img-fluid" alt="{{ $room->name }}">
                                    @endif
                                </div>
                                <p><strong>Price:</strong> ${{ $room->price }}</p>
                                <p><strong>Available:</strong> {{ !$room->is_occupied ? 'Yes' : 'No' }}</p>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
