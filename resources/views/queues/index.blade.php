@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ຄິວການຜະລິດສິນຄ້າ ມີຄິວທັງໝົດ: <span style="color: crimson;">{{ $total_queue }}</span> ຄິວ
                        <div class="pull-right">
                            <a href="{{ route('queues.finish') }}" class="btn btn-primary">ລາຍການຜະລິດທີ່ສຳເລັດແລ້ວ</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="GET" action="/products" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <fieldset>

                            </fieldset>
                        </form>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ລຳດັບຄິວ</th>
                            <th>ວັນທີອອກບິນ</th>
                            <th>ເລກທີບິນ</th>
                            <th>ຊື່ລູກຄ້າ</th>
                            <th>ຜູ້ຮັບວຽກ</th>
                            <th>ສະຖານະ</th>
                            <th>ເລື່ອນຂຶ້ນ</th>
                            <th>ເລື່ອນລົງ</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; $last = count($queues) + 1; ?>
                        @forelse($queues as $queue)
                            <?php $no++; ?>
                            <tr>
                                <td>{{ $queue->queue }}</td>
                                <td>{{ Carbon\Carbon::parse($queue->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $queue->bill_id }}</td>
                                <td>{{ $queue->customer_name }}</td>
                                <td>{{ $queue->user_name }}</td>
                                <td>{{ $queue->status }}</td>

                                @if($no == 2)
                                    <td>&nbsp;</td>
                                @else
                                    <td><a href="{{ route('queues.up', ['bill_id' => $queue->bill_id, 'queue' => $queue->queue]) }}" class="btn btn-primary"> ^ </a> </td>
                                @endif

                                @if($no == $last)
                                    <td>&nbsp;</td>
                                @else
                                    <td><a href="{{ route('queues.down', ['bill_id' => $queue->bill_id, 'queue' => $queue->queue]) }}" class="btn btn-primary"> - </a> </td>
                                @endif
                                <td><a href="{{ route('product.description', ['bill_id' => $queue->bill_id]) }}" class="btn btn-primary">ລາຍລະອຽດ</a> </td>
                                <td><a href="{{ route('queues.complete', ['bill_id' => $queue->bill_id, 'queue' => $queue->queue]) }}" class="btn btn-success">ສຳເລັດແລ້ວ</a> </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" style="color: red;">ບໍ່ມີລາຍການຄິວການຜະລິດ</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection()
