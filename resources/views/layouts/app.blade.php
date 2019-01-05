<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
   <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-theme.css') }}" rel="stylesheet">
</head>
<body  style="background: #f6f4ff;">
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    3D P&S<!-- {{ config('App', 'Laravel') }} -->
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                        <li><a href="{{ route('customers.sale') }}">ຂາຍສິນຄ້າ</a></li>
                        <li><a href="{{ route('billing.index') }}">ໃບບິນ</a></li>
                        <li><a href="{{ route('quotations.index') }}">ໃບສະເໜີລາຄາ</a></li>
                        <li><a href="{{ route('buys.index') }}">ສັ່ງຊື້ສິນຄ້າ</a></li>
                        <li><a href="{{ route('categories.index') }}">ໝວດສິນຄ້າ</a></li>
                        <li><a href="{{ route('products.index') }}">ສິນຄ້າ</a></li>
                        <li><a href="{{ route('customers.index') }}">ລູກຄ້າ</a></li>
                        <li><a href="{{ route('suppliers.index') }}">ຜູ້ສະໜອງ</a></li>
                        <li><a href="{{ route('queues.index') }}">ຄິວການຜະລິດ</a></li>
                        <li><a href="{{ route('rate.index') }}">ອັດຕາແລກປ່ຽນ</a></li>
                        <li><a href="{{ route('admin.register') }}">ສະມາຊິກ</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                ລາຍງານ <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('reportSales.index') }}">ລາຍການຂາຍ</a>
                                    <a href="{{ route('reportSalesMadeOrder.index') }}">ລາຍການຂາຍ ແບບຂຽນບິນ</a>
                                    <a href="{{ route('reportQuotations.index') }}">ໃບສະເໜີລາຄາ</a>
                                    <a href="{{ route('reportProducts.index') }}">ລາຍການສິນຄ້າ</a>
                                    <a href="{{ route('reportIncomes.index') }}">ລາຍຮັບ</a>
                                    <a href="{{ route('reportPayments.index') }}">ລາຍຈ່າຍ</a>
                                    <a href="{{ route('reportQueues.index') }}">ຄິວການຜະລິດ</a>
                                    <a href="{{ route('reportBuys.index') }}">ໃບສັ່ງຊື້ສິນຄ້າ</a>
                                </li>
                            </ul>
                        </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">ເຂົ້າລະບົບ</a></li>
                        <!--<li><a href="{{ route('register') }}">ລົງທະບຽນ</a></li>-->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        ອອກລະບົບ
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<!--<script src="{{ asset('js/app.js') }}"></script> -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap3-typeahead.min.js') }}"></script>
<script src="{{ asset('js/myscript.js') }}"></script>
<script src="{{ asset('js/jquery.printPage.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/npm.js') }}"></script>
</body>
</html>
