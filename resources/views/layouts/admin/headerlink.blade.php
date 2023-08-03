<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 admin dashboard template & web App ui kit.">
    <meta name="keyword"
        content="LUNO, Bootstrap 5, ReactJs, Angular, Laravel, VueJs, ASP .Net, Admin Dashboard, Admin Theme, HRMS, Projects, Hospital Admin, CRM Admin, Events, Fitness, Music, Inventory, Job Portal">
    <link rel="icon" href="{{ url('assets') }}/img/favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <title>:: Restaurant 360 :: Record your inventory and analyze your sales</title>
    <!-- Application vendor css url -->
    <link rel="stylesheet" href="{{ url('assets') }}/cssbundle/dataTables.min.css">
    <link rel="stylesheet" href="{{ url('assets') }}/cssbundle/daterangepicker.min.css">
    {{-- <link rel="stylesheet" href="{{ url('assets') }}/cssbundle/swiper.min.css"> --}}
    <!-- project css file  -->
    <link rel="stylesheet" href="{{ url('assets') }}/css/luno-style.css">
    <!-- Jquery Core Js -->
    <script src="{{ url('assets') }}/js/plugins.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"
        integrity="sha384-tc3TMXCcTCib89yECEQXI4e6DhhlwNrqzYpvyeSqBD2vB/KugQH7o3p+/UtKuS5L" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--<script src="{{ url('assets') }}/js/bundle/dataTables.bundle.js"></script>-->
    <style>
        .loader {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            display: none;
        }

        .loader-list {
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -90px 0 0 -80px;
        }


        .loader {
            position: absolute;
            top: 80px;
            left: 65px;
            color: white;
            border-radius: 50%;
            transition: 1s all;
        }

        .loader-top {
            position: absolute;
            border: 5px solid transparent;
            border-top-color: black;
            border-radius: 50%;
            -webkit-animation: loading linear infinite;
            -moz-animation: loading linear infinite;
            -o-animation: loading linear infinite;
            animation: loading linear infinite;
        }

        .loader-bottom {
            position: absolute;
            border: 5px solid transparent;
            border-bottom-color: #13d506;
            border-radius: 50%;
            -webkit-animation: loading linear infinite;
            -moz-animation: loading linear infinite;
            -o-animation: loading linear infinite;
            animation: loading linear infinite;
        }

        .loader-top.one {
            top: 24px;
            left: 15px;
            width: 120px;
            height: 120px;
            animation-duration: 1s;
        }

        .loader-top.two {
            top: 37px;
            left: 30px;
            width: 90px;
            height: 90px;
            animation-duration: 1.2s;
        }

        .loader-top.three {
            top: 50px;
            left: 40px;
            width: 70px;
            height: 70px;
            animation-duration: 1.4s;
        }

        .loader-top.four {
            top: 64px;
            left: 50px;
            width: 50px;
            height: 50px;
            animation-duration: 1.6s;
        }

        .loader-bottom.one {
            top: 23px;
            left: 15px;
            width: 120px;
            height: 120px;
            animation-duration: 1s;
        }

        .loader-bottom.two {
            top: 42px;
            left: 30px;
            width: 90px;
            height: 90px;
            animation-duration: 1.2s;
        }

        .loader-bottom.three {
            top: 51px;
            left: 40px;
            width: 70px;
            height: 70px;
            animation-duration: 1.4s;
        }

        .loader-bottom.four {
            top: 59px;
            left: 50px;
            width: 50px;
            height: 50px;
            animation-duration: 1.6s;
        }

        @-webkit-keyframes loading {
            from {
                -webkit-transform: rotateZ(360deg);
                -moz-transform: rotateZ(360deg);
                -ms-transform: rotateZ(360deg);
                transform: rotateZ(360deg);
            }

            to {
                -webkit-transform: rotateZ(0);
                -moz-transform: rotateZ(0);
                -ms-transform: rotateZ(0);
                transform: rotateZ(0);
            }
        }

        @-moz-keyframes loading {
            from {
                -webkit-transform: rotateZ(360deg);
                -moz-transform: rotateZ(360deg);
                -ms-transform: rotateZ(360deg);
                transform: rotateZ(360deg);
            }

            to {
                -webkit-transform: rotateZ(0);
                -moz-transform: rotateZ(0);
                -ms-transform: rotateZ(0);
                transform: rotateZ(0);
            }
        }

        @-ms-keyframes loading {
            from {
                -webkit-transform: rotateZ(360deg);
                -moz-transform: rotateZ(360deg);
                -ms-transform: rotateZ(360deg);
                transform: rotateZ(360deg);
            }

            to {
                -webkit-transform: rotateZ(0);
                -moz-transform: rotateZ(0);
                -ms-transform: rotateZ(0);
                transform: rotateZ(0);
            }
        }

        @-ms-keyframes loading {
            from {
                -webkit-transform: rotateZ(360deg);
                -moz-transform: rotateZ(360deg);
                -ms-transform: rotateZ(360deg);
                transform: rotateZ(360deg);
            }

            to {
                -webkit-transform: rotateZ(0);
                -moz-transform: rotateZ(0);
                -ms-transform: rotateZ(0);
                transform: rotateZ(0);
            }
        }

        @keyframes loading {
            from {
                -webkit-transform: rotateZ(360deg);
                -moz-transform: rotateZ(360deg);
                -ms-transform: rotateZ(360deg);
                transform: rotateZ(360deg);
            }

            to {
                -webkit-transform: rotateZ(0);
                -moz-transform: rotateZ(0);
                -ms-transform: rotateZ(0);
                transform: rotateZ(0);
            }
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            min-height: calc(1.5em + 1.8rem + 0px);
        }

        .select2-container--default .select2-selection--single {
            min-height: calc(1.5em + 1.8rem + 0px);
        }

        .form-control.form-control-lg {
            margin: 10px 0;
        }

        .img-style img.img-fluid {
            filter: none;
        }

        .bg-redish {
            background: #FFEDD5;
        }

        .bg-violet {
            background: #6B21A8;
        }

        .bg-yello {
            background: #FACC15;
        }

        .card.fieldset {
            margin-bottom: 60px;
            margin-top: 60px;
        }

        .payment .card-body {
            padding: 8px;
        }

        .sticky-top.sticky-right {
            top: 100px;
        }

        /* Pagination container */
        .dataTables_paginate {
            text-align: center;
            margin-top: 10px;
        }

        /* Pagination buttons */
        .dataTables_paginate .paginate_button {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            background-color: #eaeaea;
            color: #333;
            border-radius: 3px;
            cursor: pointer;
        }

        /* Current page button */
        .dataTables_paginate .paginate_button.current {
            background-color: #007bff;
            color: #fff;
        }

        /* Disabled button */
        .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            cursor: default;
        }

        /* Pagination button hover */
        .dataTables_paginate .paginate_button:hover {
            background-color: #ccc;
        }
    </style>

</head>
