@extends('home')
@section('content')
    <!-- Form section -->
    <!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
        <div class="container">
            <div class="row g-3 mb-3 align-items-center">
                <div class="col">
                    <ol class="breadcrumb bg-transparent mb-0">
                        <li class="breadcrumb-item"><a class="text-secondary" href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-secondary" href="javascript:void()">Menu Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List of Menu Product</li>
                    </ol>
                </div>
                <div class="col text-md-end">
                    <a class="btn btn-primary" href="{{ url('ingredients/create') }}"><i class="fa fa-list me-2"></i>Create
                        Ingredient Item</a>
                    {{-- <a class="btn btn-secondary" href="{{ 'agents/create' }}"><i class="fa fa-user me-2"></i>Create
                        Agent</a> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- start: page body -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3> List of Ingredients</h3>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table display dataTable table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Ingredient Name</th>
                                    <th>Ingredient Code</th>
                                    <th>Ingredient Measurement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productList as $product)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->product_measure_status }}</td>
                                        {{-- <td></td> --}}
                                        {{-- <a href="{{ 'products/' . $product->product_id . '/' . 'edit' }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="deleteNow({{ $product->product_id }})">Delete</button>
                                            <a href="{{ 'products/' . $product->product_id }}"
                                                class="btn btn-sm btn-info">View</a>
                                            <a href="{{ 'get-product-barcode/' . $product->product_id }}"
                                                class="btn btn-sm btn-info">Barcode</a> --}}

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end form section -->


    <script type="text/javascript">
        function deleteNow(params) {

            var isConfirm = confirm('Are You Sure!');
            if (isConfirm) {

                $('.loader').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: "products" + '/' + params,
                    success: function(data) {
                        location.reload();

                    }
                }).done(function() {
                    $("#success_msg").html("Data Save Successfully");
                    //window.location.href = "{{ url('users') }}/";
                    Swal.fire('Menu Item Has Been Deleted', '', 'success')
                }).fail(function(data, textStatus, jqXHR) {
                    $('.loader').hide();
                    var json_data = JSON.parse(data.responseText);
                    $.each(json_data.errors, function(key, value) {
                        $("#" + key).after(
                            "<span class='error_msg' style='color: red;font-weigh: 600'>" +
                            value +
                            "</span>");
                    });
                });
            } else {
                $('.loader').hide();
            }




            // })
        }
    </script>
@endsection
