@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px;">ຮູບສິນຄ້າຈິງທີ່ຜະລິດໄດ້
                    <div class="pull-right">
                        <a href="{{ route('show.product.desc.edit.finishphoto.form',
                        ['bill_id'=>$bill[0]->bill_id,
                        'customer_name'=>$bill[0]->customer_name,
                        'product_name'=>$order->name,
                        'order_id' => $order_id]) }}" class="btn btn-primary">ແກ້ໄຂ</a>
                        <a href="{{ route('product.description.finish', ['bill_id' => $bill[0]->bill_id]) }}" class="btn btn-success">ກັບຄືນ</a>
                    </div>
                </div>
                <div class="col-lg-2"></div><div class="col-lg-2">ເລກທີບິນ:</div>
                <div class="col-lg-8">{{ $bill[0]->bill_id }}</div>
                <div class="col-lg-2"></div><div class="col-lg-2">ລູກຄ້າ:</div>
                <div class="col-lg-8">{{ $bill[0]->customer_name }}</div>
                <div class="col-lg-2"></div><div class="col-lg-2">ລາຍການ:</div>
                <div class="col-lg-8">{{ $order->name }}</div>
                <div class="panel-body">
                <table class="table" style="width: 100%;">
                    <tr style="background: lightskyblue; color: ghostwhite; font-size: 20px;">
                        <th style="text-align: center;">ຮູບສິນຄ້າຈິງທີ່ຜະລິດໄດ້</th>
                    </tr>
                    <tr>
                        <td>
                            <img style="width: 90%;" src="{{ asset("/storage/photos/finishphotos/$order->finishphoto") }}">
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
