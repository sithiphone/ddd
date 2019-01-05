@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍການສິນຄ້າຜະລິດສຳເລັດແລ້ວ
                        <div class="pull-right">
                            <a href="{{ route('queues.index') }}" class="btn btn-primary">ລາຍການຄິວລໍຖ້າຜະລິດ</a>
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
                            <th>ລຳດັບ</th>
                            <th>ວັນທີອອກບິນ</th>
                            <th>ເລກທີບິນ</th>
                            <th>ຊື່ລູກຄ້າ</th>
                            <th>ຜູ້ຮັບວຽກ</th>
                            <th>ສະຖານະ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; $last = count($finishs) + 1; ?>
                        @forelse($finishs as $finish)

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>{{ Carbon\Carbon::parse($finish->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $finish->bill_id }}</td>
                                <td>{{ $finish->customer_name }}</td>
                                <td>{{ $finish->user_name }}</td>
                                <td>{{ $finish->status }}</td>
                                <td><a href="{{ route('product.description.finish', ['bill_id' => $finish->bill_id]) }}" class="btn btn-success">ຮູບສິນຄ້າຈິງ</a> </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" style="color: red;">ບໍ່ມີລາຍການຄິວການຜະລິດ</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $finishs->links() }}
            </div>
        </div>
    </div>
@endsection()
