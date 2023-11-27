<!DOCTYPE html>
<html>
<head>
    <base href="/public">
@include('user.css.style')
<style>
    .invoice-title h2, .invoice-title h5 {
            display: inline-block;
        }
        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
        .table-condensed > tbody > tr > td,
        .table-condensed > tbody > tr > th,
        .table-condensed > thead > tr > td,
        .table-condensed > thead > tr > th {
            border: none;
        }
        .container{
            margin-top: 25px;
            /* border: 1px solid black; */
            width: 65%;
        }
</style>

</head>
<body class="sub_page">
<!-- about section -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="invoice-title">
                <h5><strong>Invoice</strong></h5>
                <h5 class="float-right"><strong>Order #{{$order->order_id}}</strong></h5>
            </div>
            <hr>
            <div class="row ">
                <div class="col-md-6">
                    <address>
                    <strong>Billed From:</strong><br>
                    Cambodian Foods<br>
                        +84 888255118<br>
                        cambodianfoods@gmail.com<br>
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
                        <strong>Delivery Status:</strong><br>
                        {{$order->delivery_status}}<br>
                        
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
                    <h5 class="panel-title"><strong>Order Summary</strong></h5>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead >
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
                                    <td class="text-center">{{ $orderItem->price }}$</td>
                                    <td class="text-center">{{ $orderItem->quantity }}</td>
                                    <td class="text-right">{{ $orderItem->price * $orderItem->quantity }}$</td>
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
    <div class="d-print-none">
        <div class="float-right">
            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i>PRINT</a>
        
        </div>
    </div><br>
</div>

<!-- end about section -->
<!-- footer section -->
@include('user.js.script')
</body>
</html>




