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
                        <li class="breadcrumb-item"><a class="text-secondary" href="javascript:void()">Suppliers</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List of Suppliers</li>
                    </ol>
                </div>
                <div class="col text-md-end">
                    <a class="btn btn-primary" href="{{ url('suppliers/create') }}"><i class="fa fa-list me-2"></i>Create
                        Supplier</a>
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
                        <h3> Supplier List</h3>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table display dataTable table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Photo</th>
                                    <th>Supplier Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    {{-- <th>Branch</th> --}}
                                    <th>Supplier Entry ID</th>
                                    {{-- <th>Opening Balance</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplierList as $suppliers)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if ($suppliers->supplier_image != null)
                                                <img src="{{ asset('public') . '/' . $suppliers->supplier_image }}"
                                                    alt="" width="30px" height="30px">
                                            @endif
                                        </td>
                                        <td>{{ $suppliers->supplier_name }}</td>
                                        <td>{{ $suppliers->supplier_phone_number }}</td>
                                        <td>{{ $suppliers->supplier_email }}</td>
                                        {{-- <td>{{ $suppliers->branch_id }}</td> --}}
                                        <td>{{ $suppliers->supplier_entry_id }}</td>
                                        {{-- <td>{{ $suppliers->supplier_opening_balance }}</td> --}}
                                        <td>
                                            <a href="{{ 'suppliers/' . $suppliers->supplier_id . '/' . 'edit' }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="deleteNow({{ $suppliers->supplier_id }})">Delete</button>
                                        </td>
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
                    url: "suppliers" + '/' + params,
                    success: function(data) {
                        location.reload();

                    }
                }).done(function() {
                    $("#success_msg").html("Data Save Successfully");
                    //window.location.href = "{{ url('users') }}/";
                    Swal.fire('Supplier Has Been Deleted', '', 'success')
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

        $(document).ready(function() {
            $('#myTable')
                .dataTable();


        });
    </script>
@endsection
