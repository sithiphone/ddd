@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ຂໍ້ມູນລາຍລະອຽດສິນຄ້າ
                        <div class="pull-right">
                            @if($from == 'REPORT')
                                <a href="{{ route('reportProducts.index') }}" class="btn btn-primary">ກັບຄືນ</a>
                            @else
                                <a href="{{ route('products.index') }}" class="btn btn-primary">ກັບຄືນ</a>
                            @endif

                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-5">
                            @if($product->photo != '')
                                <img src="{{ asset("/storage/photos/products/$product->photo") }}" style="width: 340px;" />
                            @else
                                <img src="{{ asset("/storage/photos/products/no_photo.jpg") }}" style="width: 340px;" />
                            @endif
                        </div>
                        <div class="col-md-7 " >
                            <div class="panel-heading">
                                <h1>ປະເພດ: {{ $product->category_name }}</h1>
                                <h1>ລະຫັດ: {{ $product->code }}</h1>
                                <h1>{{ $product->name }}</h1>
                                <h2>ລາຄາ: {{ number_format($product->price) }} ກີບ</h2>
                            </div>

                            <div class="panel-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()