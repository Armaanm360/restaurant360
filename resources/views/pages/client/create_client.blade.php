
 @extends('home')
 @section('content')
<!-- Form section -->
    <!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
        <div class="container-fluid">
            <div class="row g-3 mb-3 align-items-center">
                <div class="col">
                    <ol class="breadcrumb bg-transparent mb-0">
                        <li class="breadcrumb-item"><a class="text-secondary" href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-secondary" href="javascript:void()">Customer</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Customer</li>
                    </ol>
                </div>
                <div class="col text-md-end">
                    <a class="btn btn-primary" href="{{ url('client') }}"><i class="fa fa-list me-2"></i>List Customer</a>
                    {{-- <a class="btn btn-secondary" href="{{ 'agents/create' }}"><i class="fa fa-user me-2"></i>Create
    Agent</a> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="container-fluid">
            <div class="row g-3">


                <!-- Form Validation -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Create Customer</h6>
                        </div>
                        <div class="card-body">
                            <form class="row g-3 maskking-form" id="client_form">
                                @csrf
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input type="text" class="form-control form-control-lg" id="client_name"
                                            placeholder="Client Name" name="client_name">
                                        <label class="form-label" for="TextInput">Customer Name</label>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input type="text" class="form-control form-control-lg" id="client_entry_id"
                                            placeholder="Client Entry ID" name="client_entry_id" readonly>
                                        <label class="form-label" for="TextInput">Customer Entry ID</label>
                                    </span>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input type="number" class="form-control form-control-lg" id="client_phone_number"
                                            placeholder="Client Phone" name="client_phone_number">
                                        <label class="form-label" for="client_phone_number">Customer Phone</label>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input type="email" class="form-control form-control-lg" id="client_email"
                                            placeholder="Client Email" name="client_email">
                                        <label class="form-label" for="client_email">Customer Email</label>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input type="text" class="form-control form-control-lg" id="client_address"
                                            placeholder="Client Address" name="client_address">
                                        <label class="form-label" for="supplier_address">Customer Address</label>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <select name="branch_id" id="branch_id" class="form-control">
                                            <option value="">Select Branch</option>
                                            @foreach ($branchlist as $item)
                                                <option value="{{$item->branch_id}}">{{$item->branch_name}}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label" for="branch_id">Branch</label>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <label class="form-group float-label">
                                        <select class="form-control form-control-lg custom-select"
                                            name="client_type">
                                            <option value="" disabled selected>
                                                {{ __('Select Customer Type') }}
                                            </option>
                                            <option value="ONLINE">Online</option>
                                            <option value="WHOLE_SALE">Whole Sale</option>
                                        </select>
                                        <span>Customer Type</span>
                                    </label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input class="form-control" type="file" id="filecheck" name="client_image" accept=".jpg,.png,.jpeg">
                                        <label class="form-label" for="supplier_image">Customer Image</label>
                                    </span>
                                </div>



                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- .row end -->

        </div>
    </div>
    <!-- end form section -->

    <script type="text/javascript">
        $('#client_name').keyup(function() {
            let rand = $('#client_name').val();
            let x = Math.floor((Math.random() * 100000) + 1);

            $('#client_entry_id').val(rand + x);

        });


        $("#client_form").submit(function(e) {
            e.preventDefault();
            $(this).find(':input[type=submit]').prop('disabled', true);
            $(".error_msg").html('');
            $('.loader').show();
            var data = new FormData($('#client_form')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('client') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    $('.loader').hide();
                    window.location.href = "{{ url('client') }}";
                }
            }).done(function() {
                $("#success_msg").html("Data Save Successfully");
                $('.loader').hide();
                window.location.href = "{{ url('client') }}";
                // location.reload();
            }).fail(function(data, textStatus, jqXHR) {
                $("#loader").hide();
                $(this).find(':input[type=submit]').prop('enabled', true);
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    $("#" + key).after(
                        "<span class='error_msg' style='color: red;font-weigh: 600'>" + value +
                        "</span>");
                });
            });
        });

        var uploadField = document.getElementById("filecheck");

            uploadField.onchange = function() {
                if(this.files[0].size > 2097152){
                alert("File is too big!");
                this.value = "";
                };
            };
    </script>

@endsection
