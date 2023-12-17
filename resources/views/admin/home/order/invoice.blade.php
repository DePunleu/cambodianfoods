<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css.style')
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .small-width {
            width:150px;
        }
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }
        .table > tbody > tr > .no-line {
            border-top: none;
        }
        .table > thead > tr > .no-line {
            border-bottom: none;
        }
        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
    </style>
</head>
<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    @include('admin.layout.header')
    <!-- Sidebar menu-->
    @include('admin.layout.sidebar')
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            @if(!empty(Auth::guard('web')->user()->image))
            <img class="app-sidebar__user-avatar" src="{{asset('backend/images/'.Auth::guard('web')->user()->image)}}" width="70px" alt="User Image">
            @else
            <img src="{{asset('backend/images/admin.png')}}" width="70px" class="img-circle elevation-2" alt="User Image">
            @endif
            <div>
            <a href="#" class="d-block">{{Auth::guard('web')->user()->name}}</a>
            <p class="app-sidebar__user-designation">Admin</p>
            </div>
        </div>
        <ul class="app-menu">
            <li>
                <a class="app-menu__item" href="{{url('admin/dashboard')}}">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>
            <li >
                <a class="app-menu__item" href="{{url('/admin/users')}}" >
                    <i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Users</span>         
                </a>
                
            </li>
            <li>
                <a class="app-menu__item " href="{{url('/admin/menu')}}" >
                    <i class="fas fa-utensils"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Menus</span>
                    
                </a>
                
            </li>
            <li>
                <a class="app-menu__item" href="{{url('/admin/submenu')}}" >
                    <i class="fas fa-utensils"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Sub Menus</span>
                    
                </a>
                
            </li>
            <li >
                <a class="app-menu__item" href="{{url('/admin/item')}}" >
                    <i class="fas fa-hamburger"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Items</span>
                    
                </a>
                
            </li>
        
            <li >
                <a class="app-menu__item active" href="{{url('/admin/order')}}" >
                    <i class="fa fa-shopping-cart"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Orders</span>
                    
                </a>
                
            </li>
        </ul>
    </aside>
    <!-- Body-->
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Orders</h1>          
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Orders</li>
                <li class="breadcrumb-item active"><a href="#">Invoice</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body" id="invoice-details">
                        <div class="table-title">
                            <div class="row">                
                                <div class="col-sm-10">
                                    
                                </div>
                                <div class="d-print-none col-sm-2">
                                    <div class="float-right">
                                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light">
                                            <i class="fa fa-print"></i>PRINT
                                        </a>
                                    
                                    </div>
                                </div>
                            </div><br>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="invoice-title">
                                        <h2>Invoice</h2>
                                        <h3 class="float-right">Order # {{$order->order_id}}</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                            <strong>Billed From:</strong><br>
                                                Khmer Foods<br>
                                                +84 888255118<br>
                                                khmerfoods@gmail.com<br>
                                                Ngo 74, Truong Chinh, Phuong Mai, Dong Da, Hanoi
                                                
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <address>
                                            <strong>Shipped To:</strong><br>
                                                {{$order->name}}<br>
                                                {{$order->phone}}<br>
                                                {{$order->email}}<br>
                                                {{$order->address}}
                                                
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <strong>Payment Method:</strong><br>
                                                {{$order->payment_status}}<br>
                                                
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <address>
                                                <strong>Order Date:</strong><br>
                                                {{$order->created_at}}<br><br>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><strong>Order summary</strong></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>#</strong></td>
                                                            <td><strong>Item</strong></td>
                                                            <td class="text-center"><strong>Price</strong></td>
                                                            <td class="text-center"><strong>Quantity</strong></td>
                                                            <td class="text-right"><strong>Totals</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $totalprice=0; ?>
                                                        @foreach ($order->orderItems as $index => $orderItem)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $orderItem->items->title }}</td>
                                                            <td class="text-center">${{ $orderItem->price }}</td>
                                                            <td class="text-center">{{ $orderItem->quantity }}</td>
                                                            <td class="text-right">${{ $orderItem->price * $orderItem->quantity }}</td>
                                                        </tr>
                                                        <?php $totalprice=$totalprice + ($orderItem->price*$orderItem->quantity); ?>
                                                        @endforeach                             
                                                        <tr>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                                            <td class="thick-line text-right">{{$totalprice}}$</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>

                                                            <td class="no-line text-center"><strong>Shipping</strong></td>
                                                            <td class="no-line text-right">0$</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>

                                                            <td class="no-line text-center"><strong>Total</strong></td>
                                                            <td class="no-line text-right"><strong>{{$totalprice}}$</strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>                
            </div>
        </div>
            
            
    </main>
    <!-- Essential javascripts for application to work-->
    @include('admin.js.script') 

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    $(document).ready(function() {
    $('.order-status-select').on('change', function() {
        var select = $(this);
        var orderId = select.data('order-id');
        var status = select.val();
        var url = select.data('url');

        // Send an AJAX request to update the status
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                orderId: orderId,
                status: status
            },
            success: function(response) {
                console.log('AJAX request successful');
                console.log(response); // Debug: Check the response object
                if (response.success) {
                    // Update the delivery status text
                    $('#delivery-status-' + orderId).text(status);
                } else {
                    console.log(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX request failed');
                console.log(error); // Debug: Check the error message
            }
        });
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.10.2/jspdf.umd.min.js"></script>
<script>
  // Function to generate and download the PDF
    function downloadPDF() {
        // Get the invoice section element
        var element = document.getElementById('invoice-details');
        // Create a new canvas element to capture the section
        html2canvas(element).then(function(canvas) {
        // Convert the canvas to an image data URL
        var imgData = canvas.toDataURL('image/png');
        // Create a new jsPDF instance
        var pdf = new jsPDF();
        // Set the document size based on the captured section
        var width = canvas.width * 0.75;
        var height = canvas.height * 0.75;
        // Add the image to the PDF
        pdf.addImage(imgData, 'PNG', 15, 15, width, height);
        // Generate a filename for the PDF
        var filename = 'invoice.pdf';
        // Download the PDF file
        pdf.save(filename);
        });
    }
  // Attach click event listener to the "Download PDF" button
    var downloadBtn = document.getElementById('download-pdf');
    downloadBtn.addEventListener('click', downloadPDF);
</script>
</body>
</html>