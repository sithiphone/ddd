@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ອັດຕາແລກປ່ຽນ
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('rate.edit',$rate->id) }}">ປັບປຸງອັດຕາແລກປ່ຽນ</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table hover">
                            <thead>
                            <tr>
                                <th>ວັນທີ</th>
                                <th>ບາດ</th>
                                <th>ໂດລາ</th>
                                <th>ເອີໂຣ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $date }}</td>
                                <td>{{ $rate->bath }}</td>
                                <td>{{ $rate->dolar }}</td>
                                <td>{{ $rate->erro }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
