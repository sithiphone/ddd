@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ສ້າງລາຍການຂາຍ
                        <div class="pull-right">
                            <a href="{{ route('customers.sale') }}" class="btn btn-success">ເລືອກລູກຄ້າ</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="{{ route('customers.create') }}" class="btn btn-primary" >ເພີ່ມລູກຄ້າ</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('bills.create') }}">
                            <div class="col-md-6">
                                <select name="sel_category" class="form-control" onchange="this.form.submit()">
                                    <option value="*">ທຸກໝວດສິນຄ້າ</option>
                                    @foreach($categories as $category)
                                        @if($sel_cat == $category->id)
                                            <option selected="selected" value="{{ $category->id }}">{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="text" name="searchproduct" value="" placeholder="ຊື່ສິນຄ້າ" class="form-control">
                            </div>
                            <div class="col-md-1">
                                <input type="submit" value="ຄົ້ນຫາສິນຄ້າ" class="btn btn-success">
                            </div>
                        </form>
                        <div class="col-md-5" style="text-align: center;">
                            <div class="col-lg-4">
                                <img src="{{ asset("/storage/photos/icons/th.png") }}"> {{ number_format($rate->bath) }}
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset("/storage/photos/icons/usa.png") }}"> {{ number_format($rate->dolar) }}
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset("/storage/photos/icons/erro.png") }}"> {{ number_format($rate->erro) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="col-md-7">
                            <table class="table table-hover">
                                <thead>
                                <tr style="text-align: center; font-size: 20px;">
                                    <th>ລະຫັດສິນຄ້າ</th>
                                    <th>ຮູບພາບ</th>
                                    <th>ລາຍການ</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ $product->code }}</td>
                                        @if($product->photo != '')
                                            <td><img src="{{ asset("/storage/photos/products/$product->photo") }}"  style="height: 100px;"/></td>
                                        @else
                                            <td><img src="{{ asset("/storage/photos/products/no_photo.jpg")  }}"  style="height: 100px;"/></td>
                                        @endif
                                        <td>{{ $product->name }}</td>
                                        <td>

                                            <?php $sign = false; ?>
                                            @if(null !== Session::get('order.items') )
                                                @foreach (Session::get('order.items') as $item)
                                                    @if($product->id == $item['product_id'])
                                                        <?php $sign = true; ?>
                                                        @break
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if($sign)
                                                <form action="{{ route('bills.create') }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('POST') }}
                                                    <input type="number" name="amount" value="{{ $item['amount'] }}" disabled class="form-control" style="width: 80px;"><br />
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" name="button" value="CANCEL" class="btn btn-danger">ຍົກເລີກ</button>
                                                </form>
                                            @else
                                                <form action="{{ route('bills.create') }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('POST') }}
                                                    <input type="number" name="amount" class="form-control" style="width: 80px;"><br />
                                                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                                                    <input type="hidden" name="product_price" value="{{ $product->price }}">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" name="button" value="ADD_CART" class="btn btn-primary">ເພີ່ມເຂົ້າ</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" style="text-align: center; color: red;">ບໍ່ມີລາຍການສິນຄ້າໃນຖານຂໍ້ມູນ</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-5">
                            <table class="table table-bordered" style="background: white;">
                                <thead>
                                    <tr>
                                        <th colspan="6">
                                            <form action="{{ route('orders.create') }}">
                                                {{ csrf_field() }}
                                                {{ method_field('GET') }}
                                                <input type="hidden" name="customer_id" value="{{ session('customerId') }}">
                                                <table class="table">
                                                    <tr>
                                                        <td><label><input type="radio" name="curency" value="kip" checked="checked"> ກີບ</label></td>
                                                        <td><label><input type="radio" name="curency" value="bath"> ບາດ</label></td>
                                                        <td><label><input type="radio" name="curency" value="dolar"> ໂດລາ</label></td>
                                                        <td><label><input type="radio" name="curency" value="erro"> ເອີໂຣ</label></td>
                                                        <td><button type="submit" name="button" value="BILLING" class="btn btn-success">ຄິດໄລ່ເງິນ</button></td>
                                                        <td><a href="{{ route('bills.create', ['clear_cart'=>'yes']) }}" class="btn btn-danger">ລ້າງບິນ</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            ມັດຈຳເງິນ <input type="number" name="deposit" class="form-control" value="">
                                                        </td>
                                                        <td colspan="2">
                                                            ລວມອາກອນ 10% <input type="checkbox" name="tax" class="form-control" value="1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">ບ່ອນສົ່ງ:
                                                        <input type="text" name="ship_place" value="" class="form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">ໄລຍະຮັບປະກັນ:</td>
                                                        <td><label><input type="radio" name="warranty" value="1" checked="checked">1 ເດືອນ</label></td>
                                                        <td><label><input type="radio" name="warranty" value="3">3 ເດືອນ</label></td>
                                                        <td><label><input type="radio" name="warranty" value="6">6 ເດືອນ</label></td>
                                                        <td><label><input type="radio" name="warranty" value="12">12 ເດືອນ</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">ກຳນົດສົ່ງສິນຄ້າ:
                                                            <input type="date" name="ship_date" class="form-control">
                                                        </td>
                                                        <td colspan="3">ກຳນົດການຈ່່າຍເງິນ:
                                                            <input type="date" name="pay_date" class="form-control">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </th>
                                    </tr>
                                    <tr><th colspan="6" style="font-size: 20px; text-align: center;">ລູກຄ້າ: {{ session('customerName') }}</th></tr>
                                    <tr>
                                        <th>ລຳດັບ</th>
                                        <th>ລາຍການ</th>
                                        <th>ຈຳນວນ</th>
                                        <th>ລາຄາ</th>
                                        <th>ເປັນເງິນ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(null !== Session::get('order.items'))
                                    <?php $no = 1; $total_kip = 0;?>
                                    @foreach(Session::get('order.items') as $key => $item)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $item['product_name'] }}</td>
                                            <td>{{ $item['amount'] }}</td>
                                            <td>{{ number_format($item['product_price']) }}</td>
                                            <td>{{ number_format($item['product_price'] * $item['amount']) }}</td>
                                            <td><a href="{{ route('bills.create', ['del_item'=>$key]) }}" class="btn btn-danger">X</a></td>
                                        </tr>
                                        <?php
                                        $no++;
                                        $total_kip += ($item['product_price'] * $item['amount']);
                                        ?>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align: right;">ເປັນເງິນກີບ</td>
                                        <td>{{ number_format($total_kip / 1) }}</td><td>ກີບ</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: right;">ເປັນເງິນບາດ</td>
                                        <td>{{ number_format($total_kip / $rate->bath) }}</td><td>ບາດ</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: right;">ເປັນເງິນໂດລາ</td>
                                        <td>{{ number_format($total_kip / $rate->dolar) }}</td><td>ໂດລາ</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: right;">ເປັນເງິນເອີໂຣ</td>
                                        <td>{{ number_format($total_kip / $rate->erro) }}</td><td>ເອີໂຣ</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()