@extends('layouts.app')
<style type="text/css">
    .main_menu_box{
        width: 120px;
        float: left;
        margin-top: 50px;
        text-align: center;
        height: 150px;
    }
    .main_menu_box:hover{
        border: 2px solid white;
    }
    .title_box{
        text-align: center;
        font-size: 18px;
    }
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 40px; text-align: center; background: #98cbe8; color: snow;">ລະບົບຖານຂໍ້ມູນ ບໍລິສັດ 3D Printing&Sign</div>

                <div class="panel-body">
                    <div class="icon_container">
                        <div class="main_menu_box">
                            <div><a href="{{ route('customers.sale') }}"><img style="height: 100px;" src="{{ asset("/storage/photos/icons/sale.png") }}"></a></div>
                            <div class="title_box">ຂາຍເຄື່ອງ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('billing.index') }}"><img style="height: 100px;" src="{{ asset("/storage/photos/icons/billing.png") }}"></a></div>
                            <div class="title_box">ໃບບິນ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('quotations.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/quotation.png") }}"></a></div>
                            <div class="title_box">ໃບສະເໜີລາຄາ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('buys.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/order.png") }}"></a></div>
                            <div class="title_box">ສັ່ງຊື້ສິນຄ້າ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('categories.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/categories.png") }}"></a></div>
                            <div class="title_box">ໝວດສິນຄ້າ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('products.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/product.png") }}"></a></div>
                            <div class="title_box">ສິນຄ້າ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('customers.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/customer.png") }}"></a></div>
                            <div class="title_box">ລູກຄ້າ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('suppliers.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/supplier.png") }}"></a></div>
                            <div class="title_box">ຜູ້ສະໜອງ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('queues.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/queue.png") }}"></a></div>
                            <div class="title_box">ຄິວຜະລິດ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('rate.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/exchange.png") }}"></a></div>
                            <div class="title_box">ອັດຕາແລກປ່ຽນ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('admin.register') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/member.png") }}"></a></div>
                            <div class="title_box">ພະນັກງານ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('reportSales.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/report.png") }}"></a></div>
                            <div class="title_box">ລາຍງານ ລາຍການຂາຍ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('reportQuotations.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/report.png") }}"></a></div>
                            <div class="title_box">ລາຍງານ ໃບສະເໜີລາຄາ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('reportProducts.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/report.png") }}"></a></div>
                            <div class="title_box">ລາຍງານ ລາຍການສິນຄ້າ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('reportIncomes.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/report.png") }}"></a></div>
                            <div class="title_box">ລາຍງານ ລາຍຮັບ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('reportPayments.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/report.png") }}"></a></div>
                            <div class="title_box">ລາຍງານ ລາຍຈ່າຍ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('reportQueues.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/report.png") }}"></a></div>
                            <div class="title_box">ລາຍງານ ຄິວການຜະລິດ</div>
                        </div>
                        <div class="main_menu_box">
                            <div><a href="{{ route('reportBuys.index') }}"><img style="height: 100px;"  src="{{ asset("/storage/photos/icons/report.png") }}"></a></div>
                            <div class="title_box">ລາຍງານ ໃບສັ່ງຊື້ສິນຄ້າ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
