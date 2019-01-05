@extends('layouts.app')

@section('content')
    <div class="container" style="width: 1360px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍງານຄິວການຜະລິດ
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <fieldset>
                                <div class="col-md-2">
                                    <input type="text" name="bill_no" value="{{ $bill_no }}" placeholder="ເລກທີບິນ" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="customer_name" value="{{ $customer_name }}" placeholder="ຊື່ລູກຄ້າ" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="user_name" value="{{ $user_name }}" placeholder="ຜູ້ຮັບວຽກ" class="form-control">
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
                            <th>ລຳດັບຄິວ</th>
                            <th>ວັນທີອອກບິນ</th>
                            <th>ເລກທີບິນ</th>
                            <th>ຊື່ລູກຄ້າ</th>
                            <th>ຜູ້ຮັບວຽກ</th>
                            <th>ສະຖານະ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($queues as $queue)
                            <tr>
                                <td>{{ $queue->queue }}</td>
                                <td>{{ Carbon\Carbon::parse($queue->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $queue->bill_id }}</td>
                                <td>{{ $queue->customer_name }}</td>
                                <td>{{ $queue->user_name }}</td>
                                <td>{{ $queue->status }}</td>
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