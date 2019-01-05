@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">ຜູ້ສະໜອງສິນຄ້າ
                        <div class="pull-right" style="margin-bottom: 20px;">
                            <a class="btn btn-success" href="{{ route('suppliers.create') }}">ສ້າງຜູ້ສະໜອງສິນຄ້າໃໝ່</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div style="margin: 10px 0px 20px 0px;">
                            <form action="{{ route('suppliers.index') }}" method="GET">
                                <div class="col-md-8">
                                    <input type="text" name="searchtext" class="form-control">
                                </div>
                                <div class="col-md-1">
                                    <input type="submit" value="ຄົ້ນຫາຜູ້ສະໜອງ" class="btn btn-success">
                                </div>
                            </form>
                        </div>

                        <table class="table table-hover" style="margin-top: 20px;">
                            <tr>
                                <th>ລຳດັບ</th>
                                <th>ຜູ້ສະໜອງ</th>
                                <th>ເບີຕິດຕໍ່ທີ1</th>
                                <th>ເບີຕິດຕໍ່ທີ2</th>
                                <th>ອີເມວ໌</th>
                                <th>ທີ່ຢູ່</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($suppliers as $key => $supplier)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->mobile1 }}</td>
                                    <td>{{ $supplier->mobile2 }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('suppliers.edit',$supplier->id) }}">ແກ້ໄຂຂໍ້ມູນ</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display: inline;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" CLASS="btn btn-danger" onclick="return confirm('ຕ້ອງການລຶບແທ້ບໍ?')">ລຶບ</button>
                                        </form>
                                    </td>
                                    <td><a class="btn btn-success" href="{{ route('buys.edit', ['id' => $supplier->id]) }}">ສັ່ງຊື້ເຄື່ອງ</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                {!! $suppliers->render() !!}
            </div>
        </div>
    </div>
@endsection