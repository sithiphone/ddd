@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ເລືອກລູກຄ້າເພື່ອສ້າງລາຍການຂາຍ
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('customers.create') }}">ເພີ່ມລູກຄ້າໃໝ່</a>
                        </div>
                    </div>
                    <div class="panel-body" style="margin-top: 40px;">
                        <form class="form-horizontal" action="{{ route('customers.sale') }}" method="GET">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <div class="col-md-3">
                                <input type="text" placeholder="ຊື່ລູກຄ້າ" value="{{ $searchtext }}" name="searchtext" class="form-control" >
                            </div>
                            <div class="col-md-3">
                                <input type="text" placeholder="ເບີໂທລະສັບ" value="{{ $mobile }}" name="mobile" class="form-control" >
                            </div>

                            <div class="col-md-3">
                                <input type="text" placeholder="ອີເມລ໌" value="{{ $email }}" name="email" class="form-control" >
                            </div>
                            <div class="col-md-1">
                                <button type="submit" name="button" value="SEARCH" class="btn btn-primary">ຄົ້ນຫາ</button>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ລະຫັດ</th>
                                    <th>ຂື່ ແລະ ນາມສະກຸນ</th>
                                    <th>ເບີໂທລະສັບທີ1</th>
                                    <th>ເບີໂທລະສັບທີ2</th>
                                    <th>ອີເມວ໌</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->code }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->mobile1 }}</td>
                                        <td>{{ $customer->mobile2 }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            <form method="post" action="{{ route('bills.billing', ['customer_id' => $customer->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('POST') }}
                                                <input type="submit"  value="ສ້າງລາຍການສັ່ງຊື້" class="btn btn-success">
                                            </form>
                                        </td>
                                        <td><a href="{{url("write/billing/$customer->id")}}" class="btn btn-success">ຂຽນບິນເອງ</a> </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="font-size: 20px; color: red; text-align: center;">ບໍ່ມີລາຍການລູກຄ້າໃນຖານຂໍ້ມູນ!</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection()
