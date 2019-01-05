@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">ລາຍການໃບສັ່ງຊື້ສິນຄ້າ
                        <div class="pull-right" style="margin-bottom: 20px;">
                            <a class="btn btn-success" href="{{ route('suppliers.index') }}">ເລືອກຜູ້ສະໜອງ</a>
                            <a class="btn btn-success" href="{{ route('suppliers.create') }}">ສ້າງຜູ້ສະໜອງສິນຄ້າໃໝ່</a>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div style="margin: 10px 0px 20px 0px;">
                            <form action="{{ route('buys.index') }}" method="GET">
                                <div class="col-md-8">
                                    <input type="text" name="searchtext" class="form-control">
                                </div>
                                <div class="col-md-1">
                                    <input type="submit" value="ຄົ້ນຫາ" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                        <br />
                        <table class="table table-hover" style="margin-top: 20px;">
                            <tr>
                                <th>ລຳດັບ</th>
                                <th>ລະຫັດ</th>
                                <th>ສະເໜີວັນທີ</th>
                                <th>ຜຸ້ສະໜອງ</th>
                                <th>ຜູ້ສັ່ງຊື້</th>
                                <th>ສະຖານະ</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php $no = 1; ?>
                            @foreach ($buys as $key => $buy)
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td>{{ $buy->code }}</td>
                                    <td>{{ \Carbon\Carbon::parse($buy->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ $buy->supplier_name }}</td>
                                    <td>{{ $buy->name }}</td>
                                    <td><?php if($buy->status == 1){echo "ຮັບເຄື່ງແລ້ວ";}else{ echo "ລໍຖ້າເຄື່ອງ";  } ?></td>
                                    @if($buy->status == 1)
                                        <td><a class="btn btn-success" href="{{ route('buys.updatePrice', ['id' => $buy->id]) }}">ເຂົ້າສາງແລ້ວ</a></td>
                                    @else
                                        <td><a class="btn btn-danger" href="{{ route('buys.updatePrice', ['id' => $buy->id]) }}">ຮັບເຄື່ອງເຂົ້າສາງ</a></td>
                                    @endif
                                    <td><a class="btn btn-primary" href="{{ route('buys.show', ['buy_id' => $buy->id]) }}">ເບິ່ງລາຍລະອຽດ</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                {!! $buys->links() !!}
            </div>
        </div>
    </div>
@endsection