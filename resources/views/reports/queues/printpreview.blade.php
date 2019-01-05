@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 style="text-align: center; text-decoration: underline;">ລາຍງານຄິວການຜະລິດ</h2>
                    <p>&nbsp;</p>
                    <div class="col-md-10 col-md-offset-1">
                        <table>
                            <tbody>
                            <tr>
                               <td style="font-size: 20px;">ຮ້ານ ສາມດີ</td>
                               <td style="width: 200px;"></td>
                               <td>ວັນທີ: {{ Carbon\Carbon::now()->format('d-m-Y h:m') }}</td>
                            </tr>
                            <tr>
                                <td>ຖະໜົນທົ່ງປົ່ງ, ປ້ານ ທົ່ງປົ່ງ, ເມືອງ ສີໂຄດຕະບອງ, ແຂວງນະຄອນຫຼວງວຽງຈັນ</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>ເບີໂທລະສັບ 22233344, 55566677</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-11 col-md-offset-1">
                        <table class="table table-bordered">
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
                    <div class="col-md-10 col-md-offset-1">
                        <table style="width: 100%;">
                            <tbody>
                            <tr>
                                <td>ຜູ້ສ້າງລາຍງານ</td>
                                <td style="width: 240px;">ນາຍບັນຊີ</td>
                                <td>ຫົວໜ້າການເງິນ</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>{{ Auth::user()->name }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()