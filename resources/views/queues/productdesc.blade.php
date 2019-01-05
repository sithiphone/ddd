@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍລະອຽດການຜະລິດສິນຄ້າ
                        <div class="pull-right">
                            <a href="{{ route('queues.index') }}" class="btn btn-primary">ກັບຄືນ</a>
                        </div>
                    </div>
                    <div class="col-md-4" style="background: #bce8f1;">
                        ບິນເລກທີ:{{ $bill[0]->bill_id }}
                    </div>
                    <div class="col-md-4" style="background: #bce8f1;">
                        ລູກຄ້າ: {{ $bill[0]->customer_name }}
                    </div>
                    <div class="col-md-4" style="background: #bce8f1;">
                        ອອກວັນທີ {{ \Carbon\Carbon::parse($bill[0]->created_at)->format('d-m-Y') }}
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ລຳດັບ</th>
                            <th>ລາຍການຜະລິດ/ສິນຄ້າ</th>
                            <th>ຈຳນວນ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;  ?>
                        @forelse($orders as $order)
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->amount }}</td>
                                @if($order->status == 1)
                                    <td><a href="{{ route('show.product.desc', ['order_id'=>$order->id, 'bill_id'=>$order->bill_id]) }}" class="btn btn-success">ແກ້ໄຂລາຍລະອຽດການຜະລິດ</a> </td>
                                @else
                                    <td><a href="{{ route('show.productdescription.form', ['id'=>$order->id, 'bill_id'=>$order->bill_id, 'name'=>$order->name]) }}" class="btn btn-danger">ກຳນົດລາຍລະອຽດການຜະລິດ</a> </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="color: red;">ບໍ່ມີລາຍການສິນຄ້າໃນໃບບິນ</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection()
