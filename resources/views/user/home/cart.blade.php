<!DOCTYPE html>
<html>
<head>
  @include('user.css.style')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
  integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    .row{
      width: 90%;
      margin-left: 5%;
    }
    .custom-input {
      width: 30%;
      margin-left: 35%;
    }
    .custom{
      padding-top: 110px;
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
  <div class="px-4 px-lg-0 min-vh-100">
    <div class="pb-5">
      <div class="container ">
        <div class="row">
          <div class="col-lg-12 bg-white rounded shadow-sm mb-5 custom ">
            <!-- Shopping cart table -->
            <div class="table-responsive">
              <table class="table">
                <thead class="text-center">
                  <tr>
                    <th scope="col" class="border-0 bg-light">
                      <div class="p-2 px-3 text-uppercase">#</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="p-2 px-3 text-uppercase">Item
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Price</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Quantity</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Subtotal</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Remove</div>
                    </th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php $totalprice=0; ?>
                  @foreach ($cart as $row)
                  <tr data-id="{{ $row->id }}">
                    <td class="border-0 align-middle text-center">{{$counts++}}</td>
                    <td class="border-0 align-middle text-center">
                      <img src="{{url('upload/item_images/'.$row->image)}}" alt="" width="90" class="img-fluid rounded shadow-sm">
                    </td>
                    <td class="border-0 align-middle ">
                      {{$row->title}}
                    </td>
                    <td class="border-0 align-middle text-center">{{$row->price}}$</td>
                    <td class="border-0 align-middle p-4 text-center ">
                      <input type="number" min="1" name="cart_quantity" value="{{$row->quantity}}" class="form-control form-control-sm custom-input text-center quantity cart_update">
                    </td>
                    <td class="border-0 align-middle text-center">{{$row->price*$row->quantity}}$</td>
                    
                    <td class="border-0 align-middle text-center"><a href="{{url('/cart/'.$row->id)}}" onclick="confirmation(event)" class="btn btn-danger delete "><i class="fa fa-trash"></i></a></td>
                   
                  </tr>
                 
                    
                  <?php $totalprice=$totalprice + ($row->price*$row->quantity); ?>
                  @endforeach
              
                </tbody>
              </table>
            </div>
            <!-- End -->
            <hr class="my-12">
           
            <div class="col-lg-12">
            <div class="d-flex justify-content-between py-3 float-right">
                    <!-- New button to direct to menu -->
                    <div class="p-4">
                      <!-- Your existing content here -->

                      <!-- New button -->
                      <a href="{{url('/menu')}}" class="btn btn-primary rounded-pill py-2 btn-block">Add new order</a>
                    </div>
            </div>
              
              <div class="p-4">
                
                <ul class="list-unstyled mb-4">
                  
                  <li class="d-flex justify-content-between py-3"><h5><strong>Total</strong></h5>
                    <h5 class="font-weight-bold">{{$totalprice}}$</h5>
                  </li>
                  
                </ul>
                
                <a href="{{url('/checkout')}}" class="btn btn-dark rounded-pill py-2 btn-block">Checkout</a>
              </div>
            </div>
            {{-- <hr class="my-3"> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
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

  {{-- Sweet Alert Message --}}
  <script>
    function confirmation(ev) {
      ev.preventDefault();
      var urlToRedirect = ev.currentTarget.getAttribute('href');
      console.log(urlToRedirect);
      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        
        buttons: {
          
          confirm: {
            text: 'Yes, delete it!',
            className: 'btn btn-success'
          },
          cancel: {
            visible: true,
            className: 'btn btn-danger'
          }
        },
        customClass: {
        confirmButton: 'swal-center-btn'
      }
      }).then((Delete) => {
        if (Delete) {
          // Perform deletion or redirect to the URL for deletion
          window.location.href = urlToRedirect;
        } else {
          swal.close();
        }
      });
    }
  </script>

</body>
</html>




