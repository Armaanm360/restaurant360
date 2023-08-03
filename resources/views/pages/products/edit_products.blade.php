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
                        <li class="breadcrumb-item"><a class="text-secondary" href="javascript:void()">Menu Item</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Menu Item</li>
                    </ol>
                </div>
                <div class="col text-md-end">
                    <a class="btn btn-primary" href="{{ url('products') }}"><i class="fa fa-list me-2"></i>List of Menu Item</a>
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
                            <h6 class="card-title mb-0">Edit Menu Item</h6>
                        </div>
                        <div class="card-body">
                            <form class="row g-3 maskking-form" id="product_form">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="product_id" value="{{ $data->product_id }}">
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <select class="form-control form-control-lg custom-select" name="product_category">
                                            <option value="" disabled selected>
                                                {{ __('Select Menu') }}
                                            </option>
                                            @foreach ($productCategory as $category)
                                                <option value="{{ $category->product_category_id }}"
                                                    @if ($category->product_category_id == $data->product_category) selected @endif>
                                                    {{ $category->product_category_name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label" for="TextInput">Product Menu</label>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input type="text" class="form-control form-control-lg" id="product_name"
                                            placeholder="Product Name" name="product_name"
                                            value="{{ $data->product_name }}">
                                        <label class="form-label" for="TextInput">Menu Item Name</label>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input type="text" class="form-control form-control-lg" id="product_entry_id"
                                            placeholder="Product Entry ID" name="product_entry_id"
                                            value="{{ $data->product_entry_id }}" readonly>
                                        <label class="form-label" for="TextInput">Menu Item Entry ID</label>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input type="text" class="form-control form-control-lg" id="product_code"
                                            placeholder="Product Code" name="product_code" value="{{ $data->product_code }}"
                                            readonly>
                                        <label class="form-label" for="TextInput">Menu Item Code</label>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input type="text" class="form-control form-control-lg" id="product_retail_price"
                                            placeholder="Product Retail Price" name="product_retail_price"
                                            value="{{ $data->product_retail_price }}">
                                        <label class="form-label" for="TextInput">Menu Item Retail Price</label>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input type="text" class="form-control form-control-lg" id="product_retail_price"
                                            placeholder="Product Wholesale Price" name="product_wholesale_price"
                                            value="{{ $data->product_wholesale_price }}">
                                        <label class="form-label" for="TextInput">Menu Item Wholesale Price</label>
                                    </span>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <span class="float-label">
                                        <input class="form-control" type="file" id="file-input" name="product_image"
                                            accept=".jpg,.png,.jpeg">
                                        <label class="form-label" for="product">Menu Item Image</label>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div id='img_contain'>
                                        {{-- <img id="image-preview"
                                            align='middle'src="http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png"
                                            alt="your image" title='' /> --}}

                                        @if ($data->product_image != null)
                                            <img id="image-preview" align='middle'
                                                src="{{ asset('public/uploads/products') . '/' . $data->product_image }}"
                                                alt="">
                                        @endif
                                    </div>
                                </div>



                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
        $("#product_form").submit(function(e) {
            e.preventDefault();
            $(".error_msg").html('');
            var data = new FormData($('#product_form')[0]);
            let getpassport_id = $("[name=product_id]").val();
            $('#loader').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('products') }}/" + $("[name=product_id]").val(),
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    window.location.href = "{{ url('products') }}";
                }
            }).done(function() {
                $("#success_msg").html("Data Save Successfully");
                //window.location.href = "{{ url('users') }}/";
                // location.reload();
            }).fail(function(data, textStatus, jqXHR) {
                $('#loader').hide();
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    $("#" + key).after(
                        "<span class='error_msg' style='color: red;font-weigh: 600'>" + value +
                        "</span>");
                });
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                    $('#image-preview').hide();
                    $('#image-preview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file-input").change(function() {
            readURL(this);
        });

        var uploadField = document.getElementById("filecheck");

        uploadField.onchange = function() {
            if (this.files[0].size > 2097152) {
                alert("File is too big!");
                this.value = "";
            };
        };
    </script>
@endsection
