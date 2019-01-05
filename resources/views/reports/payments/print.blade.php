@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="pull-right">
                    <a href="{{ route('reports.payments.printpreview', [
                    'button' => 'PRINT',
                    'on' => $sel_on,
                    'from_date' => $from_date,
                    'to_date' => $to_date]) }}" class="btnPrint btn btn-primary" >Print preview</a>
                </div>
                <div class="panel-body">
                    <h2 style="text-align: center; text-decoration: underline;">ລາຍງານລາຍຈ່າຍ
                        @if($sel_on == 1)
                            ປະຈຳວັນ {{ Carbon\Carbon::now()->format('d-m-Y') }}
                        @elseif($sel_on == 2)
                            ປະຈຳເດືອນ {{ Carbon\Carbon::now()->format('m-Y') }}
                        @elseif($sel_on == 3)
                            ປະຈຳປີ {{ Carbon\Carbon::now()->format('Y') }}
                        @endif
                    </h2>
                    <p>&nbsp;</p>
                    <div class="col-md-10 col-md-offset-1">
                        <table>
                            <tbody>
                            <tr>
                               <td style="font-size: 20px;">ຮ້ານ ສາມດີ</td>
                               <td style="width: 200px;"></td>
                               <td>ວັນທີ: {{ Carbon\Carbon::now()->format('d-m-Y') }}</td>
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
                                <th>ລຳດັບ</th>
                                <th>ວັນທີ</th>
                                <th>ເລກທີໃບບິນ</th>
                                <th>ຜູ້ສັ່ງຈ່າຍ</th>
                                <th>ລາຍຈ່າຍຂອງໃບບິນ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $total = 0;?>
                            @forelse($payments as $payment)
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>{{ Carbon\Carbon::parse($payment->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ $payment->buy_id }}</td>
                                    <td>{{ $payment->user_name }}</td>
                                    <td>{{ number_format($payment->payamount) }}</td>
                                </tr>
                                <?php $total += $payment->payamount; ?>
                            @empty
                                <tr><td colspan="5" style="color: red;">ບໍ່ມີລາຍການຂາຍໃນໃບບິນ</td></tr>
                            @endforelse
                            <tr><td colspan="4" style="text-align: center;">ລວມລາຍຈ່າຍ</td><td>{{ number_format($total) }}</td></tr>
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