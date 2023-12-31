<x-app-layout>

    <head>
        <link href="path/to/lightbox.css" rel="stylesheet" />
        <style>
            .rate {
                float: left;
                height: 46px;
                padding: 0 10px;
                }
                .rate:not(:checked) > input {
                position:absolute;
                display: none;
                }
                .rate:not(:checked) > label {
                float:right;
                width:1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:30px;
                color:#ccc;
                }
                .rated:not(:checked) > label {
                float:right;
                width:1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:30px;
                color:#ccc;
                }
                .rate:not(:checked) > label:before {
                content: '★ ';
                }
                .rate > input:checked ~ label {
                color: #ffc700;
                }
                .rate:not(:checked) > label:hover,
                .rate:not(:checked) > label:hover ~ label {
                color: #deb217;
                }
                .rate > input:checked + label:hover,
                .rate > input:checked + label:hover ~ label,
                .rate > input:checked ~ label:hover,
                .rate > input:checked ~ label:hover ~ label,
                .rate > label:hover ~ input:checked ~ label {
                color: #c59b08;
                }
                .star-rating-complete{
                   color: #c59b08;
                }
                .rating-container .form-control:hover, .rating-container .form-control:focus{
                background: #fff;
                border: 1px solid #ced4da;
                }
                .rating-container textarea:focus, .rating-container input:focus {
                color: #000;
                }
                .rated {
                float: left;
                height: 46px;
                padding: 0 10px;
                }
                .rated:not(:checked) > input {
                position:absolute;
                display: none;
                }
                .rated:not(:checked) > label {
                float:right;
                width:1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:30px;
                color:#ffc700;
                }
                .rated:not(:checked) > label:before {
                content: '★ ';
                }
                .rated > input:checked ~ label {
                color: #ffc700;
                }
                .rated:not(:checked) > label:hover,
                .rated:not(:checked) > label:hover ~ label {
                color: #deb217;
                }
                .rated > input:checked + label:hover,
                .rated > input:checked + label:hover ~ label,
                .rated > input:checked ~ label:hover,
                .rated > input:checked ~ label:hover ~ label,
                .rated > label:hover ~ input:checked ~ label {
                color: #c59b08;
                }
                           #album {
                background-color: #f8f9fa;
                padding: 30px 0;
            }

            .book-details {
                margin-bottom: 20px;
            }

            .book-details h1 {
                font-size: 24px;
                margin-bottom: 10px;
            }

            .review-form {
                margin-bottom: 20px;
            }

            .rating-container {
                margin-top: 10px;
            }

            .average-rating {
                font-size: 18px;
                margin-top: 20px;
                margin-bottom: 10px;
            }

            #album {
                background-color: #f8f9fa;
                padding: 30px 0;
            }

            .book-details {
                margin-bottom: 20px;
            }

            .book-details h1 {
                font-size: 24px;
                margin-bottom: 10px;
            }

            .review-form {
                margin-bottom: 20px;
            }

            .rating-container {
                margin-top: 10px;
            }

            .average-rating {
                font-size: 18px;
                margin-top: 20px;
                margin-bottom: 10px;
            }
       </style>  
    </head>

    <section id="album">
        <div class="container">

            <div class="d-flex flex-column align-items-end">
                <form action="{{ route('buku.favorite', $buku->id) }}" method="POST" class="favorite-form">
                    @csrf
                    <button type="submit" class="btn btn-link favorite-button">
                        @if (Auth::user()->favorites && Auth::user()->favorites->contains($buku))
                            <i class="fas fa-heart text-danger fa-2x"></i>
                        @else
                            <i class="far fa-heart text-secondary fa-2x"></i>
                        @endif
                    </button>
                </form>
                <span class="mt-2">Favorite</span>
            </div>            
            
            <form class="review-form mt-4" action="{{ route('buku.rating', $buku->id) }}" method="POST" autocomplete="off" id="ratingForm">
                @csrf
                <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                <h1>Review</h1>
                <div class="form-group row">
                    <div class="col">
                        <div class="rate">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" class="rate" name="rating" value="{{ $i }}"
                                    {{ ($existingRating && $existingRating->rating == $i) ? 'checked disabled' : '' }}
                                    onchange="document.getElementById('ratingForm').submit()">
                                <label for="star{{ $i }}" title="{{ $i }} stars">{{ $i }} stars</label>
                            @endfor
                        </div>
                    </div>
                </div>
            </form>                   
    
            <div class="average-rating">
                @if (!empty($rating))
                    Average Rating: {{ number_format($rating, 1) }}
                @else
                    Rating is not available
                @endif
            </div>
            
            <hr class="mb-4">
    
            <div class="flex flex-wrap text-center -mx-4">
                @forelse ($galeris as $gallery)
                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 px-4 mb-8">
                        <div class="bg-white rounded-lg overflow-hidden shadow-md">
                            <a href="{{ asset($gallery->path) }}" data-lightbox="image-1" data-title="{{ $gallery->keterangan }}" class="mt-4">
                                <img src="{{ asset($gallery->path) }}" alt="{{ $gallery->nama_galeri }}" class="mx-auto mt-4">
                            </a>                            
                            <div class="p-4">
                                <h5 class="text-lg mb-2">{{ $gallery->nama_galeri }}</h5>
                                <p class="text-gray-600">{{ $gallery->keterangan }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="w-full px-4 mb-8">
                        <p class="text-center text-gray-600">No images found.</p>
                    </div>
                @endforelse
            </div>
    
            <div class="mt-2">{{ $galeris->links('vendor.pagination.bootstrap-5') }}</div>
        </div>
    </section>    
    
</x-app-layout>