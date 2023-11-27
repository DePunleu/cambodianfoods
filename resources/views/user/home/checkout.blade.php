<!DOCTYPE html>
<html>
<head>
@include('user.css.style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" 
integrity="sha512-gOQQLjHRpD3/SEOtalVq50iDn4opLVup2TF8c4QPI3/NmUPNZOk2FG0ihi8oCU/qYEsw4P6nuEZT2lAG0UNYaw==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .row{
        width: 90%;
        margin-left: 5%;
        }
        .custom-input {
        width: 30%;
        margin-left: 35%;
        }
        .padding{
            padding-top: 100px
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
    <!-- end header section -->
    </div>
<!-- about section -->
    <div class="px-4 px-lg-0">
        <div class="pb-5">
            <div class="container">
                <div class="row padding">
                    <div class="col-md-8">
                    <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                        @include('sweetalert::alert')
                        @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{session('success')}}
                            </div>
                        @endif
                        <form id="checkoutForm" method="POST" action="{{url('/checkout')}}">
                            @csrf
                            <h4>Shipping Details</h4>
                            <hr>
                            <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="order_name" value="{{Auth::guard('web')->user()->name}}" placeholder="Full Name" required>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="order_phone" value="{{Auth::guard('web')->user()->phone}}" placeholder="Phone Number" required>
                            </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" name="order_email" value="{{Auth::guard('web')->user()->email}}" placeholder="E-mail" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="order_address" value="{{Auth::guard('web')->user()->address}}" placeholder="Address" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cashOnDelivery" value="cash_on_delivery" checked>
                                    <label class="form-check-label" for="cashOnDelivery">
                                        Cash On Delivery
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payUsingCard" value="card_payment" onclick="toggleCardForm(this)">
                                    <label class="form-check-label" for="payUsingCard">
                                        Pay Using Card
                                    </label>
                                </div>
                            </div>
                            <!-- Order Now button -->
                            <div class="form-button mt-3 text-center">
                                <button type="submit" class="btn btn-primary" id="submit">Order Now</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                        <h4>Order Summary</h4>
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-1 ">
                            <span>Subtotal</span> <span>${{$totalPrice}}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1 ">
                            <span>Shipping</span> <span>$0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1 ">
                            <span>Tax</span> <span>$0</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4 ">
                            <strong>TOTAL</strong> <strong class="text-dark">${{$totalPrice}}</strong>
                        </div>
                    </div>
                    
                </div>
                </div>
            </div>
        </div>
    </div>

<!-- end about section -->
@include('user.layout.footer')
<!-- footer section -->
@include('user.js.script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Sweet Alert --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js" 
integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" 
crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js" 
integrity="sha512-7VTiy9AhpazBeKQAlhaLRUk+kAMAb8oczljuyJHPsVPWox/QIXDFOnT9DUk1UC8EbnHKRdQowT7sOBe7LAjajQ==" 
crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<script>
function toggleCardForm(element) {
    var cardFormContainer = document.getElementById('cardFormContainer');
    if (element.value === 'card_payment') {
        cardFormContainer.style.display = 'block';
    } else {
        cardFormContainer.style.display = 'none';
    }
}

// Add an event listener to the radio buttons to trigger the toggleCardForm function
var radioButtons = document.querySelectorAll('input[name="payment_method"]');
radioButtons.forEach(function(radioButton) {
    radioButton.addEventListener('click', function() {
        toggleCardForm(this);
    });
});

</script>

</body>
</html>




