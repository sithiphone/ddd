@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍການຂໍ້ມູນລູກຄ້າ
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('customers.create') }}">ເພີ່ມລູກຄ້າ</a>
                        </div>
                    </div>
                    <div style="margin-top: 40px;">
                        <form class="form-horizontal" action="/customers" method="GET">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <div class="col-md-1">
                                ຄົ້ນຫາ
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="searchtext" class="form-control" >
                            </div>
                            <div class="col-md-1">
                                <input type="submit" value="ຄົ້ນຫາ" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ລະຫັດ</th>
                                <th>ຂື່ ແລະ ນາມສະກຸນ</th>
                                <th>ເບີໂທລະສັບທີ1</th>
                                <th>ເບີໂທລະສັບທີ2</th>
                                <th>ອີເມວ໌</th>
                                <th></th>
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
                                        <a class="btn btn-primary" href="{{ route('customers.edit',$customer->id) }}">ແກ້ໄຂຂໍ້ມູນ</a>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('customers.destroy', $customer->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="submit"  value="ລຶບ" class="btn btn-danger" onclick="return confirm('ຕ້ອງການລຶບແທ້ບໍ?')">
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('bills.billing', ['customer_id' => $customer->id]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('POST') }}
                                            <input type="submit"  value="ສ້າງລາຍການສັ່ງຊື້" class="btn btn-success">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" style="font-size: 20px; color: red; text-align: center;">ບໍ່ມີລາຍການລູກຄ້າໃນຖານຂໍ້ມູນ!</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection()
