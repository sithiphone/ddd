@extends('layouts.app')

@section('content')
    <div class="container" style="width: 1360px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍງານຂໍ້ມູນການຂາຍ
                        <div class="pull-right">
                            <a href="{{ route('customers.index') }}" class="btn btn-primary">ກັບຄືນ</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('reportSales.index') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <fieldset>
                                <div class="col-md-1">
                                    ເລກບິນ <input type="text" name="bill_no" placeholder="ເລກບິນ" class="form-control" value="{{ $bill_no }}" style="width: 100px;">
                                </div>
                                <div class="col-md-2">
                                    ຊື່ລູກຄ້າ <input type="text" name="customer_name" placeholder="ຊື່ລູກຄ້າ" class="form-control" value="{{ $customer_name }}" style="width: 200px;">
                                </div>
                                <div class="col-md-2">
                                    ຜູ້ຂາຍ
                                    <select name="user" class="form-control">
                                        <option value="*">ເລືອກຜູ້ຂາຍ</option>
                                        @foreach($users as $user)
                                            @if($user->id == $user_id)
                                                <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                                            @else
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    ແຕ່ວັນທີ
                                    <input type="date" class="form-control" name="start_date" value="{{ $start_date }}">
                                </div>
                                <div class="col-md-2">
                                    ເຖິງວັນທີ
                                    <input type="date" class="form-control" name="end_date" value="{{ $end_date }}">
                                </div>
                                <div class="col-md-2">
                                    <br />
                                    <button type="submit" name="button" value="FILTER" class="btn btn-primary">ກອງຂໍ້ມູນ</button>
                                    <button type="submit" name="button" value="PRINT" class="btn btn-primary">ສ້າງລາຍງານ</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <table class="table tatble-hover">
                        <thead>
                        <tr>
                            <th>ລຳດັບ</th>
                            <th style="width: 100px;">ວັນທີ</th>
                            <th style="width: 50px;">ເລກບິນ</th>
                            <th style="width: 100px;">ລູກຄ້າ</th>
                            <th style="width: 200px;">ເບີໂທລະສັບ</th>
                            <th>ລາຍການຂາຍ</th>
                            <th>ຜູ້ຂາຍ</th>
                            <th>ອັດຕາແລກປ່ຽນ</th>
                            <th>ຈຳນວນ</th>
                            <th>ລາຄາ</th>
                            <th>ລວມລາຍຮັບ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; $total = 0; ?>
                        @forelse($sales as $sale)
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $sale->id }}</td>
                                <td>{{ $sale->customer_name }}</td>
                                <td>{{ $sale->mobile1 }} {{ $sale->mobile2 }}</td>
                                <td>{{ $sale->product_name }}</td>
                                <td>{{ $sale->user_name }}</td>
                                <td>{{ $sale->bill_rate }}</td>
                                <td>{{ $sale->amount }}</td>
                                <td>{{ number_format($sale->price) }}</td>
                                <td>{{ number_format($sale->amount * $sale->price) }}</td>
                                <?php $total += $sale->amount * $sale->price; ?>
                            </tr>
                            @empty
                            <tr><td colspan="11" style="color: red;">ຍັງບໍ່ມີລາຍການຂາຍ</td></tr>
                        @endforelse
                            <tr><td colspan="10" style="text-align: center;">ລວມ</td><td>{{ number_format($total) }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection()