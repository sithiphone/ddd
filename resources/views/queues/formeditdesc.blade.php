@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px;">ລາຍລະອຽດການຜະລິດ</div>
                <div class="col-lg-2"></div><div class="col-lg-2">ເລກທີບິນ:</div>
                <div class="col-lg-8">{{ $bill_id }}</div>
                <div class="col-lg-2"></div><div class="col-lg-2">ລູກຄ້າ:</div>
                <div class="col-lg-8">{{ $customer_name }}</div>
                <div class="col-lg-2"></div><div class="col-lg-2">ລາຍການ:</div>
                <div class="col-lg-8">{{ $product_name }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('update.product.desc') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <input type="hidden" name="order_id" value="{{ $order_id }}">
                        <input type="hidden" name="bill_id" value="{{ $bill_id }}">
                        <input type="hidden" name="desc_id" value="{{ $desc->id }}">
                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">ລາຍລະອຽດການຜະລິດ</label>
                            <div class="col-md-6">
                                <textarea name="product_desc" class="form-control" style="height: 200px;">{{ $desc->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">ຮູບພາບປະກອບ</label>
                            <div class="col-md-6">
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    ແກ້ໄຂ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
