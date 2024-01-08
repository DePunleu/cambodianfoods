<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('user.css.style')
    <style>
        .row{
        width: 90%;
        margin-left: 5%;
        }
        .custom-input {
        width: 30%;
        margin-left: 35%;
        }
        .checked, .price span {
        color: #ff9f1a; 
        }
    </style>
</head>
<body class="sub_page">
    <div class="hero_area">
        <div class="bg-box">
        <img src="frontend/images/Prohok-Ktis.jpg" alt="">
        </div>
        <!-- header section strats -->
        @include('user.layout.header')
        
        <!-- header section strats -->
        <!-- end header section -->
    </div>
<!-- about section -->
    <section class="py-10 item_detail min-vh-100">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
            <!-- Display error message if user order exceeds available stock -->
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{session('error')}}
                    </div>
                @endif
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="upload/item_images/{{$item->image}}" alt="..." /></div>
                <div class="col-md-6">
                    <h4 class=" fw-bolder">{{ $item->title }}</h4>
                    <div class="fs-5 ">
                        <h4 class="item_price">Price <strong>${{ $item->price }}</strong></h4>
                        <span> {{ $item->orderItems->count() }} sold</span>
                        <br>
                        <span>{{ $item->store_quantity }} remaining</span>
                        <div class="stars">
                            @php
                                $rating = $item->reviews->count() > 0 ? $item->reviews->avg('stars_rated') : 0;
                                $fullStars = floor($rating);
                                $halfStar = ceil($rating - $fullStars);
                                $emptyStars = 5 - $fullStars - $halfStar;
                            @endphp
                            @for ($i = 0; $i < $fullStars; $i++)
                                <span class="fas fa-star checked"></span>
                            @endfor
                            @if ($halfStar)
                                <span class="fas fa-star-half-alt checked"></span>
                            @endif
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <span class="fas fa-star"></span>
                            @endfor
                        </div>
                        
                        <span class="review-no">{{ $item->reviews->count() }} reviews</span>
                    </div>
                    <p class="lead">{{ $item->description }}</p>
                    <form action="{{ url('add_cart', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        <div class="d-flex">
                            <input class="form-control text-center me-3" name="item_quantity" id="inputQuantity" type="number" min="1" max="{{ $item->store_quantity }}" value="1" style="max-width: 3rem" />
                            <button class="btn btn-yellow bg-dark text-white flex-shrink-0" type="submit">
                                <i class="fa fa-shopping-cart"></i>
                                Add to cart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
                    <div class="mt-4">
                        <h5>Reviews</h5>
                        @if ($item->reviews->count() > 0)
                            @foreach ($item->reviews as $review)
                                <div class="mb-3">
                                    <div>
                                        <span>
                                            <img class="rounded-circle" src="{{ 'frontend/user_images/'.$review->user->image }}" alt="User Image" height="30" width="30">                     
                                        </span>
                                        <span><strong>{{ $review->user->name }}</strong></span>
                                    </div>
                                    <div class="stars">
                                        @for ($i = 0; $i < $review->stars_rated; $i++)
                                            <span class="fa fa-star checked"></span>
                                        @endfor
                                        @for ($i = 0; $i < 5 - $review->stars_rated; $i++)
                                            <span class="fa fa-star"></span>
                                        @endfor
                                    </div>
                                    <p>{{ $review->comment }}</p>
                                    {{-- <p>{{ $review->created_at }}</p> --}}
                                    
                                </div>
                            @endforeach
                        @else
                            <p>No reviews yet.</p>
                        @endif
                    </div>
        </div>
    </section>
</div>
{{-- </section> --}}
<!-- end about section -->
@include('user.layout.footer')
<!-- footer section -->
@include('user.js.script')
{{-- Update Quantity Script --}}
<script>
    $(".cart_update").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('user.update_cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
            window.location.reload();
            }
        });
    });
</script>
</body>
</html>




