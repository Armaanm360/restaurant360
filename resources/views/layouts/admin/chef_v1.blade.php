@extends('home')
@section('content')
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="section pt-0">
            <div class="container-fluid">
                <h1 class="text-center">Orders</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>OrderID</th>
                            <th>Status</th>
                            <th>Orderd Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <input type="number" value="{{ Auth::user()->version }}" id="version">
                        @foreach ($orders as $order)
                            @if ($order == 0)
                                <tr>No Order Pending</tr>
                            @else
                                <tr data-bs-toggle="collapse" data-bs-target="#details-row-{{ $order['order_id'] }}"
                                    aria-expanded="false">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <h3 class="text-mute">#{{ $order['invoice_no'] }}</h3>
                                    </td>
                                    <td>
                                        {!! $order['order_status'] === 'PENDING'
                                            ? '<span class="text-danger">PENDING</span>'
                                            : '<span class="text-success">FINISHED</span>' !!}
                                    </td>
                                    <td>
                                        @php
                                            $carbonTimestamp = \Carbon\Carbon::parse($order['created_at']);
                                        @endphp

                                        <p>{{ $carbonTimestamp->diffForHumans() }}</p>

                                    </td>

                                    <td>
                                        @if ($order['order_status'] === 'PENDING')
                                            <button
                                                class="btn bg-secondary text-light text-uppercase rounded-0 finish_class"
                                                order_id="{{ $order['order_id'] }}">Finish</button>
                                        @endif

                                    </td>
                                </tr>
                                @foreach ($order['food_items'] as $item)
                                    <tr id="details-row-{{ $order['order_id'] }}" class="collapse">
                                        <td></td>
                                        <td>
                                            <span class="text-info">Order Detail</span>
                                        </td>
                                        <td>
                                            <strong class="text-danger">Item Name :</strong>{{ $item['item '] }}
                                        </td>
                                        <td><strong class="text-danger">Quantity :</strong> {{ $item['quantity '] }}</td>

                                    </tr>
                                @endforeach
                            @endif
                        @endforeach

                    </tbody>
                </table>


            </div>
        </div>
    </div>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;



        var pusher = new Pusher('0f74fb7e8db9a311fd35', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            swal({
                    title: "Order",
                    text: "You Have A New Incoming Order",
                    icon: "info",
                    buttons: true,

                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Order Confirmed", {
                            icon: "success",
                        });
                        location.reload();
                    } else {
                        swal("Order Rejected");
                    }
                });

        });


        $(".finish_class").click(function(e) {
            e.preventDefault();
            let order_id = $(this).attr('order_id');
            swal({
                    title: "Order",
                    text: "Complete Cooking?",
                    icon: "info",
                    buttons: true,

                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Cook Finished", {
                            icon: "success",
                        });
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "GET",
                            url: "{{ url('chef-order-update') }}" + '/' + order_id,
                            success: function(data, textStatus, jqXHR) {
                                location.reload();

                            }
                        }).done(function() {
                            location.reload();
                            // location.reload();
                        }).fail(function(data, textStatus, jqXHR) {
                            $(".loader").hide();
                            submitButton.prop('disabled', false);
                            var json_data = JSON.parse(data.responseText);
                            $.each(json_data.errors, function(key, value) {
                                $("#" + key).after(
                                    "<span class='error_msg' style='color: red;font-weigh: 600'>" +
                                    value +
                                    "</span>");
                            });
                        });



                    } else {
                        swal("Wait ....");
                    }
                });

            // alert(order_id);

            // var data = new FormData($('#accountForm')[0]);

        });
    </script>
@endsection
