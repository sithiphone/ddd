@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ໃບບິນສິນຄ້າ
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('products.create') }}">ເພີ່ມສິນຄ້າ</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="GET" action="{{ route('billing.index') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <fieldset>
                                <div class="col-md-10">
                                    <select class="form-control" name="sel_status">
                                        <option value="*">--- ທຸກສະຖານະ ---</option>
                                        @foreach($billstatus as $status)
                                            <option value="{{ $status->id }}"
                                            @if($sel_status == $status->id)
                                                {{ 'selected="selected"' }}
                                                    @endif
                                            >{{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" name="button" value="SEARCH" class="btn btn-success">ຄົ້ນຫາ</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ເລກບິນ</th>
                            <th>ລູກຄ້າ</th>
                            <th>ມັດຈຳ</th>
                            <th>ເບິ່ງລາຍລະອຽດ</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($bills as $bill)
                               <tr>
                                   <td>{{ $bill->id }}</td>
                                   <td>{{ $bill->name }}</td>
                                   <td>{{ number_format($bill->deposit) }}</td>
                                   <td><a href="{{ route('view.billing', ['bill_id'=>$bill->id]) }}" class="btn btn-primary">ເຂົ້າເບິ່ງ</a></td>

                                   <td>
                                       @if($bill->status == 6)
                                           <a href="#" class="btn btn-success">ຖືກຍົກເລີກ</a>
                                       @else
                                           <a href="{{ route('billing.index', ['bill_id' => $bill->id, 'cmd' => 'CHANGE_STATUS', 'value' => 6]) }}" class="btn btn-danger">ຖືກຍົກເລີກ</a>
                                       @endif
                                   </td>
                                   <td>
                                       @if($bill->status == 1)
                                           <a href="#" class="btn btn-success">ລໍຖ້າຄິວຜະລິດ</a>
                                       @else
                                           <a href="{{ route('billing.index', ['bill_id' => $bill->id, 'cmd' => 'CHANGE_STATUS', 'value' => 1]) }}" class="btn btn-danger">ລໍຖ້າຄິວຜະລິດ</a>
                                       @endif
                                   </td>
                                   <td>
                                       @if($bill->status == 2)
                                           <a href="#" class="btn btn-success">ກຳລັງຜະລິດ</a>
                                       @else
                                           <a href="{{ route('billing.index', ['bill_id' => $bill->id, 'cmd' => 'CHANGE_STATUS', 'value' => 2]) }}" class="btn btn-danger">ກຳລັງຜະລິດ</a>
                                       @endif
                                   </td>
                                   <td>
                                       @if($bill->status == 3)
                                           <a href="#" class="btn btn-success">ຜະລິດສຳເລັດແລ້ວ</a>
                                       @else
                                           <a href="{{ route('billing.index', ['bill_id' => $bill->id, 'cmd' => 'CHANGE_STATUS', 'value' => 3]) }}" class="btn btn-danger">ຜະລິດສຳເລັດແລ້ວ</a>
                                       @endif
                                   </td>
                                   <td>
                                       @if($bill->status == 5)
                                           <a href="#" class="btn btn-success">ສົ່ງລູກຄ້າແລ້ວ</a>
                                       @else
                                           <a href="{{ route('billing.index', ['bill_id' => $bill->id, 'cmd' => 'CHANGE_STATUS', 'value' => 5]) }}" class="btn btn-danger">ສົ່ງລູກຄ້າແລ້ວ</a>
                                       @endif
                                   </td>
                                   <td>
                                       @if($bill->status == 4)
                                           <a href="#" class="btn btn-success">ສະສາງແລ້ວ</a>
                                       @else
                                           <a href="{{ route('billing.index', ['bill_id' => $bill->id, 'cmd' => 'CHANGE_STATUS', 'value' => 4]) }}" class="btn btn-danger">ສະສາງແລ້ວ</a>
                                       @endif
                                   </td>
                               </tr>
                            @empty
                                <tr><td colspan="" style="color: red;"></td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $bills->links() }}
            </div>
        </div>
    </div>
@endsection()