@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            @include('admin.message')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order: #4F3S8J</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.orderDetails') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header pt-3">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <h1 class="h5 mb-3">Shipping Address</h1>
                                    <address>
                                        <strong>{{ $order->first_name . ' ' . $order->last_name }}</strong><br>
                                        {{ $order->address }}</br>
                                        {{ $order->city }},{{ $order->zip }},{{ $order->countryName }}</br>
                                        Phone:{{ $order->mobile }}</br>
                                        Email:{{ $order->email }}
                                    </address>
                                    <strong>Shipped Date</strong></br>
                                    @if (!empty($order->shipped_date))
                                        {{ \Carbon\Carbon::parse($order->shipped_date)->format('d M,Y') }}
                                    @else
                                        n/a
                                    @endif
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <br>
                                    <b>Order ID:</b> {{ $order->id }}<br>
                                    <b>Total:</b> ${{ $order->grand_total }}<br>
                                    <b>Status:</b>
                                    @if ($order->status == 'pending')
                                        <span class="badge bg-danger">Pending</span>
                                    @elseif($order->status == 'shipped')
                                        <span class="badge bg-info">shipped</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-success">Delivered</span>
                                    @endif
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th width="100">Price</th>
                                        <th width="100">Qty</th>
                                        <th width="100">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($orderItems))
                                        @foreach ($orderItems as $orderItem)
                                            <tr>
                                                <td>{{ $orderItem->name }}</td>
                                                <td>${{ number_format($orderItem->price, 2) }}</td>
                                                <td>{{ $orderItem->qty }}</td>
                                                <td>${{ number_format($orderItem->qty * $orderItem->price) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="3" class="text-right">Subtotal:</th>
                                            <td>${{ number_format($order->subtotal, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">
                                                Discount:{{ !empty($order->coupon_code) ? '(' . $order->coupon_code . ')' : '' }}
                                            </th>
                                            <td>${{ number_format($order->discount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Shipping:</th>
                                            <td>${{ number_format($order->shipping, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Grand Total:</th>
                                            <td>${{ number_format($order->grand_total, 2) }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <form action="{{ route('orders.changeOrderStatus', $order->id) }}" method="post"
                            name="changeOrderStatusForm" id="changeOrderStatusForm">
                            @csrf
                            <div class="card-body">
                                <h2 class="h4 mb-3">Order Status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped
                                        </option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                            Delivered</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="shipped_date">Shipped Date</label>
                                    <input type="text" value="{{ $order->shipped_date }} " name="shipped_date"
                                        id="shipped_date" class="form-control" placeholder="Shipped date">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                    </div>
                    </form>
                    <div class="card">
                        <form action="{{ route('orders.sendInvoiceEmail', $order->id) }}" method="post"
                            name="sendInvoiceEmail" id="sendInvoiceEmail">
                            @csrf
                            <div class="card-body">
                                <h2 class="h4 mb-3">Send Inovice Email</h2>
                                <div class="mb-3">
                                    <select name="userType" id="userType" class="form-control">
                                        <option value="customer">Customer</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customJS')
    <script type="text/javascript">
        //for datepicker
        $(document).ready(function() {
            $('#shipped_date').datetimepicker({
                // options here
                format: 'Y-m-d H:i:s',
            });

        });
        //for change order status
        $("#changeOrderStatusForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)

            if (confirm("Are you sure you want to change status?")) {
                $.ajax({
                    url: "{{ route('orders.changeOrderStatus', $order->id) }}",
                    type: 'post',
                    data: element.serializeArray(),
                    dataType: 'json',
                    success: function(response) {

                        window.location.href = "{{ route('admin.order', $order->id) }}";

                    }
                });
            }

        });

        //for send order email
        $("#sendInvoiceEmail").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            if (confirm("Are you sure you want to send email?")) {

                $.ajax({
                    url: "{{ route('orders.sendInvoiceEmail', $order->id) }}",
                    type: 'post',
                    data: element.serializeArray(),
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = "{{ route('admin.order', $order->id) }}";
                    }
                });
            }
        });
    </script>
@endsection
