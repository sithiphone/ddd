@extends('layouts.app')

@section('content')
    <div class="container" style="width: 1360px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍງານໃບສັ່ງຊື້ສິນຄ້າ
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <fieldset>
                                <div class="col-md-2">
                                    <input type="text" name="code" value="{{ $code }}" placeholder="ລະຫັດ" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="supplier_name" value="{{ $supplier_name }}" placeholder="ຜູ້ສະໜອງ" class="suppliername form-control">
                                    <input type="hidden" id="routeSupplierName" val="{{ route('autocompleteReportBuySupplierName') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="user_name" value="{{ $user_name }}" placeholder="ຜູ້ສັ່ງຊື້" class="username form-control">
                                    <input type="hidden" id="routeUserName" val="{{ route('autocompleteReportBuyUserName') }}">
                                </div>
                                <div class="col-md-2">
                                    <select name="status" class="form-control">
                                        <option value="*"> - - -- - - -</option>
                                        <option value="0" @if($status == 0) selected @endif>ລໍຖ້າເຄື່ອງ</option>
                                        <option value="1" @if($status == 1) selected @endif>ຮັບເຄື່ອງແລ້ວ</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="button" value="FILTER" class="btn btn-primary">ກອງຂໍ້ມູນ</button>
                                    <button type="submit" name="button" value="PRINT" class="btn btn-primary">ເບິ່ງລາຍງານ</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <table class="table tatble-hover">
                        <thead>
                        <tr>
                            <th>ລຳດັບ</th>
                            <th>ລະຫັດ</th>
                            <th>ສະເໜີວັນທີ</th>
                            <th>ຜຸ້ສະໜອງ</th>
                            <th>ຜູ້ສັ່ງຊື້</th>
                            <th>ສະຖານະ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
                        @foreach ($buys as $key => $buy)
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td>{{ $buy->code }}</td>
                                <td>{{ \Carbon\Carbon::parse($buy->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $buy->supplier_name }}</td>
                                <td>{{ $buy->name }}</td>
                                <td><?php if($buy->status == 1){echo "ຮັບເຄື່ງແລ້ວ";}else{ echo "ລໍຖ້າເຄື່ອງ";  } ?></td>
                                <td><a class="btn btn-primary" href="{{ route('buys.show', ['buy_id' => $buy->id]) }}">ເບິ່ງລາຍລະອຽດ</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection()