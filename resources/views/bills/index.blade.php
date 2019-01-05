@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 " >
            <div class="panel-heading">
                <h1>ລາຍການຂາຍ</h1>
            </div>
            <div class="panel-body">
                <div class="pull-left" style="width: 90%;">
                    <form action="/bills" method="get">
                        <div class="col-md-1" style="text-align: right;">ວັນທີ:</div>
                        <div class="col-md-2">
                            <input type="date" name="searchdate" class="form-control" >
                        </div>
                        <div class="col-md-1" style="margin-left: 10px; text-align: right;">ຊື່/ນາມກະກຸນ:</div>
                        <div class="col-md-2">
                            <input type="text" name="searchname" class="form-control" >
                        </div>
                        <div class="col-md-1" style="margin-left: 10px; text-align: right;">ເບີໂທລະສັບ:</div>
                        <div class="col-md-2">
                            <input type="text" name="searchmobile" class="form-control" >
                        </div>
                        <div class="col-md-1">
                            <input type="submit" value="SEARCH" class="btn btn-success">
                        </div>
                    </form>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('bills') }}"> Create bills</a>
                </div>
                <div >
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ວັນທີ</th>
                            <th>ລູກຄ້າ</th>
                            <th>ເບີໂທລະສັບ1</th>
                            <th>ເບີໂທລະສັບ2</th>
                            <th>ສິນຄ້າ</th>
                            <th>ຈຳນວນ</th>
                            <th>ລາຄາຕໍ່ໜ່ວຍ</th>
                            <th>ລວມເປັນເງິນ</th>
                            <th>ພະນັກງານ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($bills as $bill)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($bill->created_at)->format('d/m/Y') }}</td>
                                <td>{{ $bill->customer_name }}</td>
                                <td>{{ $bill->mobile1 }}</td>
                                <td>{{ $bill->mobile2 }}</td>
                                <td>{{ $bill->firstname }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('bills',$bill->id) }}">Edit</a>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('bills', $bill->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="submit"  value="DELETE" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" style="font-size: 20px; color: red; text-align: center;">ບໍ່ມີລາຍການໃບບິນ!</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $bills->links() }}
@endsection()
