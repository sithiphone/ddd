@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍການສັ່ງຊື້
                        <div class="pull-right">
                            <a href="{{ route('suppliers.index') }}" class="btn btn-primary">ກັບຄືນ</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div style="font-size: 15px;">
                            <div class="col-md-6">ຜູ້ສັ່ງຊື້: {{ session('firstname') }}</div>
                            <div class="col-md-6">ສັ່ງຊື້ກັບ: {{ session('supplierName') }}</div>
                        </div>
                        <div class="col-md-12" style="margin-top: 20px;">
                            <form action="{{ route('buys.create') }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}
                                <fieldset>
                                    <div class="col-md-8">
                                        <input type="text" name="name" class="product form-control" placeholder="ຊື່ລາຍການສັ່ງຊື້">
                                        <input type="hidden" id="route_product" val="{{ route('autocomplete') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="amount" class="form-control" placeholder="ສັ່ງຈຳນວນ">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="submit" value="ເພີ່ມເຂົ້າລາຍການ" class="btn btn-success">
                                    </div>
                                    <input type="hidden" name="form_submited" value="yes">
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-md-12" style="padding-left: 30px; margin-top: 20px;">
                            <form action="{{ route('buys.store') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                <input type="hidden" name="button" value="save">
                                <button class="btn btn-primary" name="button" value="save">ບັນທຶກລາຍການສັ່ງຊື້</button>
                                <button class="btn btn-primary" name="button" value="saveprint">ບັນທຶກ ແລະ ສັ່ງພິມ</button>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <table class="table hover">
                                <thead>
                                <tr>
                                    <th>ລຳດັບ</th>
                                    <th>ລາຍການ</th>
                                    <th>ຈຳນວນ</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(Session::has('buydetails'))
                                    <?php $no = 1 ?>
                                        @forelse(Session::get('buydetails') as $key => $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item['item'] }}</td>
                                                <td>{{ $item['amount'] }}</td>
                                                <td>
                                                    <form action="{{ route('buys.create', ['del_item' => $key]) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('GET') }}
                                                        <button class="btn btn-danger">DELETE</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            ຍັງບໍ່ມີລາຍການສັ່ງຊື້
                                        @endforelse

                                @else
                                    <tr><td colspan="4" style="font-size: 15px; color: red;">ຍັງບໍ່ມີລາຍການສັ່ງຊື້</td></tr>
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
