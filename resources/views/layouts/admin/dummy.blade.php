            {{-- page start --}}
            <style>
                .card-body-2 {
                    padding: 5px 10px;
                }

                section#dummy {
                    height: 85%;
                    overflow-x: hidden;
                }

                .menu-style h4 {
                    margin-bottom: 0;
                    text-align: center;
                    padding: 5px 10px;
                }

                .menu-style .card {
                    border-radius: 5px;
                }

                .table-section h4 {
                    margin-bottom: 0;
                }

                .table-section {
                    padding: 20px 0 !important;
                }

                /* ---------------------- */
                .res-section h5 {
                    color: #544fff;
                    font-size: 16px;
                    font-weight: 800;
                    text-transform: uppercase;
                }

                .res-section .res-title {
                    font-size: 32px;
                    font-weight: 800;
                    color: #000000;
                }

                .res-section a:hover {
                    box-shadow: 0 5px 10px rgba(34, 39, 54, 0.15);
                    border-radius: 0.75rem;
                }

                img {
                    filter: none !important;
                }

                .br-active {
                    border-right: 3px solid #fff;
                }

                .app-social .nav-tabs.menu-list .nav-link.active {
                    background: #09c2de;
                    color: #fff;
                }

                .layout-1 .body-layout-1 .menu-list .m-link.active {
                    background: #f5364a;
                    color: #fff;
                }

                .card {
                    border-style: none !important;
                    box-shadow: 0 5px 10px 0 rgba(34, 39, 54, 0.15);
                }
            </style>
            <section id="dummy">
                <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
                    <div class="section pt-0">
                        <div class="container-fluid">
                            <div
                                class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1 g-2 mb-4 row-deck res-section justify-content-center">
                                <div class="col">
                                    <a href="{{ url('invoice') }}">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">

                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/restaurant-img-2.jpg"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5><i class="fa fa-cart-plus"></i> Pos </h5>
                                                <span class="res-title"> Point of Sale</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    @if (Auth::user()->version == 2)
                                        <a href="{{ url('products/create') }}">
                                        @else
                                            <a href="{{ url('v1products/create') }}">
                                    @endif
                                    <div class="card overflow-hidden">
                                        <div class="card-body py-4">

                                            <img class="img-fluid"
                                                src="{{ asset('/') }}assets/img/restaurant/Food.png" alt="Pos">

                                        </div>
                                        <div class="card-footer border-0">

                                            <h5 class="text-danger"><i class="fa fa-coffee"></i> Foods </h5>
                                            <span class="res-title"> Foods </span>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ url('product-category/create') }}">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/FoodCategory.png"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">

                                                <h5 class="text-primary-emphasis"><i class="fa fa-cutlery"></i> Food
                                                    Category
                                                </h5>
                                                <span class="res-title"> Food Category </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @if (Auth::user()->version == 2)
                                    <div class="col">
                                        <a href="{{ url('ingredients/create') }}">
                                            <div class="card overflow-hidden">
                                                <div class="card-body py-4">
                                                    <img class="img-fluid"
                                                        src="{{ asset('/') }}assets/img/restaurant/restaurant-img-10.jpg"
                                                        alt="Pos">

                                                </div>
                                                <div class="card-footer border-0">

                                                    <h5 class="text-primary-emphasis"><i class="fa fa-cutlery"></i>
                                                        Ingredients
                                                    </h5>
                                                    <span class="res-title"> Ingredients</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif

                                <div class="col">
                                    <a href="{{ url('purchases/create') }}">
                                        <div class="card overflow-hidden">

                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/Purchase.png"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-success"><i class="fa fa-clock-o"></i> Purchase </h5>
                                                <span class="res-title"> Purchase</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ url('report/profit-loss') }}">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/Inventory.png"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-primary"><i class="fa fa-file-text-o"></i> Inventory
                                                </h5>
                                                <span class="res-title"> Inventory</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ url('warehouse-branch-transfer/create') }}">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/Transfer.png"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-success-emphasis"><i class="fa fa-file-text-o"></i>
                                                    Transfer
                                                </h5>
                                                <span class="res-title"> Transfer</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                {{-- <div class="col">
                                    <a href="#">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/Reports.png"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-danger-emphasis"><i class="fa fa-file-text-o"></i>
                                                    Reports </h5>
                                                <span class="res-title"> Reports</span>
                                            </div>
                                        </div>
                                    </a>
                                </div> --}}
                                <div class="col">
                                    <a href="{{ url('restaurant-table/create') }}">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/Restaurant-Tables.png"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-warning"><i class="fa fa-table"></i> Restaurant Tables
                                                </h5>
                                                <span class="res-title"> Restaurant Tables</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ url('branch/create') }}">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/branches.jpg"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-warning-emphasis"><i class="fa fa-code-fork"></i>
                                                    Branches
                                                </h5>
                                                <span class="res-title"> Branches</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                {{-- <div class="col">
                                    <a href="#">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/Back-Date-Entry.jpg"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-info"><i class="fa fa-calendar"></i> Back Date Entry
                                                </h5>
                                                <span class="res-title"> Back Date Entry</span>
                                            </div>
                                        </div>
                                    </a>
                                </div> --}}
                                <div class="col">
                                    <a href="{{ url('suppliers/create') }}">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/suppliers.png"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-info-emphasis"><i class="fa fa-user"></i> Suppliers
                                                </h5>
                                                <span class="res-title"> Suppliers</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                {{-- <div class="col">
                                    <a href="#">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/transaction.jpg"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-primary"><i class="fa fa-credit-card"></i> Transaction
                                                </h5>
                                                <span class="res-title"> Transaction </span>
                                            </div>
                                        </div>
                                    </a>
                                </div> --}}
                                <div class="col">
                                    <a href="{{ url('warehouse/create') }}">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/warehouse.png"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-primary"><i class="fa fa-building"></i> Warehouse
                                                </h5>
                                                <span class="res-title"> Warehouse </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ url('accounts/create') }}">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/accounting.png"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-primary"><i class="fa fa-calculator"></i> Accounts
                                                </h5>
                                                <span class="res-title"> Accounts </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="#">
                                        <div class="card overflow-hidden">
                                            <div class="card-body py-4">
                                                <img class="img-fluid"
                                                    src="{{ asset('/') }}assets/img/restaurant/restaurant-img-6.jpg"
                                                    alt="Pos">

                                            </div>
                                            <div class="card-footer border-0">
                                                <h5 class="text-primary"><i class="fa fa-power-off"></i> Logout </h5>
                                                <span class="res-title"> Logout</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- end page start --}}
