<!DOCTYPE html>
<html>
<head>
    @include('user.css.style')
    <style>
        .table-responsive{
            border-radius: 8px;
        }
        .table thead th {
            font-size: .85rem;
            padding-top: .75rem;
            padding-bottom: .75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-bottom: 2px solid #e9ecef;
            
        }
        .table th {
            font-weight: 600;
        }
        .table td .progress {
            width: 120px;
            height: 3px;
            margin: 0;
        }
        .table td,
        .table th {
            /* font-size: .85rem; */
            white-space: nowrap;
        }
        .table.align-items-center td,
        .table.align-items-center th {
            vertical-align: middle;
        }
        .padding{
        padding-top: 100px;
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
    
        <div class="main-content">
        <div class="container mt-7 padding min-vh-100">

            <!-- Table -->
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0 py-2">Order History</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-uppercase bg-light ">#</th>
                                    <th scope="col" class="text-uppercase bg-light ">Items</th>
                                    <th scope="col" class="text-uppercase bg-light "></th>
                                    <th scope="col" class="text-uppercase bg-light text-center">Quantity</th>
                                    <th scope="col" class="text-uppercase bg-light text-center">Price</th>
                                    <th scope="col" class="text-uppercase bg-light">Status</th>
                                    <th scope="col" class="text-uppercase bg-light">Cancel</th>
                                    <th scope="col" class="text-uppercase bg-light">Date</th>
                                    <th scope="col" class="text-uppercase bg-light">Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                                $counts = 1;
                                @endphp --}}
                                @foreach ($order as $order)
                                    @foreach ($order->orderItems as $index => $item)
                                        <tr>
                                            @if ($index === 0)
                                                <td rowspan="{{ $order->orderItems->count() }}">{{ $counts++ }}</td>
                                            @endif
                                            <td>
                                                <span>
                                                    <img src="{{ url('upload/item_images/'.$item->items->image) }}" alt=""
                                                        width="50" class="img-fluid rounded shadow-sm">
                                                </span>
                                                {{ $item->items->title }}
                                            </td>
                                            <td>
                                                @if($order->delivery_status=='Completed') 
                                                <a href="{{ route('user.review', ['orderId' => $item->item_id]) }}">
                                                <button class="badge badge-primary border-primary">
                                                    Review
                                                </button>
                                                </a>
                                                @else
                                                <span class="badge badge-secondary border-secondary">
                                                    Review
                                                </span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-center">{{ $item->price }}$</td>
    
                                            @if ($index === 0)
                                                <td rowspan="{{ $order->orderItems->count() }}">
                                                    {{-- {{ $order->delivery_status }} --}}
                                                    @if ($order->delivery_status === 'Order Received')
                                                        <span class="badge badge-primary">{{ $order->delivery_status }}</span>
                                                    @elseif ($order->delivery_status === 'In-Progress')
                                                        <span class="badge badge-secondary">{{ $order->delivery_status }}</span>
                                                    @elseif ($order->delivery_status === 'Shipped')
                                                        <span class="badge badge-warning">{{ $order->delivery_status }}</span>
                                                    @elseif ($order->delivery_status === 'Delivered')
                                                        <span class="badge badge-info">{{ $order->delivery_status }}</span>
                                                    @elseif ($order->delivery_status === 'Completed')
                                                        <span class="badge badge-success">{{ $order->delivery_status }}</span>
                                                    @else
                                                    <span class="badge badge-danger">{{ $order->delivery_status }}</span>
                                                    @endif
                                                    <br>
                                                    @if ($order->payment_status === 'Paid')
                                                        <span class="badge badge-success">{{ $order->payment_status }}</span>
                                                    @elseif ($order->payment_status === 'Cash')
                                                        <span class="badge badge-warning">{{ $order->payment_status }}</span>
                                                    @else
                                                        {{ $order->payment_status }}
                                                    @endif
                                                </td>
                                            @endif
                                            @if ($index === 0)
                                                <td rowspan="{{ $order->orderItems->count() }}">
                                                    @if($order->delivery_status=='Order Received')                                                    
                                                    <a class="badge badge-danger border-danger" onclick="return confirm('Are you sure Cancel this order?')" href="{{url('cancel',$order->id)}}">
                                                        <span>Cancel</span>
                                                    </a>                                                   
                                                    @elseif($order->delivery_status=='Canceled')
                                                    <span class="badge badge-secondary border-secondary">Canceled</span>
                                                    @else
                                                    <span class="badge badge-secondary border-secondary">Cancel</span>
                                                    @endif
                                                </td>
                                            @endif
                                            @if ($index === 0)
                                                <td rowspan="{{ $order->orderItems->count() }}">{{ $order->created_at }}</td>
                                            @endif
                                            @if ($index === 0)
                                                <td rowspan="{{ $order->orderItems->count() }}">
                                                    @if($order->delivery_status=='Completed') 
                                                    <a href="{{ route('user.invoice', ['orderId' => $order->id]) }}"
                                                        target="_blank">
                                                        
                                                        <button class="badge badge-primary border-primary">
                                                            <i class="fa fa-file"></i> Invoice
                                                        </button>
                                                        
                                                    </a>
                                                    @else
                                                    <span class="badge badge-secondary border-secondary">
                                                        <i class="fa fa-file"></i> Invoice
                                                    </span>
                                                    @endif

                                                </td>
                                            @endif
    
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    






<!-- end about section -->
    @include('user.layout.footer')
    <!-- footer section -->
    @include('user.js.script')
    
</body>
</html>




