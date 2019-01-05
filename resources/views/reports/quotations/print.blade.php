@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-left: 10px; margin-right: 10px; width: 1360px;">
            <div class="panel panel-default">
                <div class="pull-right">
                    <a href="{{ route('reports.sales.printpreview', ['start_date' => $start_date,
                    'end_date' => $end_date,
                    'button' => 'PRINT',
                    'bill_no' => $bill_no,
                    'customer_name' => $customer_name,
                    'user' => $user_id]) }}" class="btnPrint btn btn-primary" >Print preview</a>
                </div>
                <div class="panel-body">
                    <h2 style="text-align: center; text-decoration: underline;">ລາຍງານການຂາຍ</h2>
                    <p>&nbsp;</p>
                    <div class="col-md-10 col-md-offset-1">
                        <table>
                            <tbody>
                            <tr>
                               <td style="font-size: 20px;">ຮ້ານ ສາມດີ</td>
                               <td style="width: 270px;"></td>
                               <td>
                                   @if($bill_no != '') ສຳລັບບິນເລກທີ: {{ $bill_no }} @endif
                                   @if($customer_name != '') ສຳລັບລູກຄ້າ: {{ $customer_name }} @endif
                                   @if($user_name != '') ສຳລັບຜູ້ຂາຍຊື່: {{ $user_name }} @endif
                                   @if($start_date != '') ລາຍງານຕາມຊ້ວງໄລຍະ @endif
                               </td>
                            </tr>
                            <tr>
                                <td>ຖະໜົນທົ່ງປົ່ງ, ປ້ານ ທົ່ງປົ່ງ, ເມືອງ ສີໂຄດຕະບອງ, ແຂວງນະຄອນຫຼວງວຽງຈັນ</td>
                                <td></td>
                                <td>@if($start_date != '') ຕັ້ງແຕ່ວັນທີ: {{ Carbon\Carbon::parse($start_date)->format('d-m-Y') }} @endif</td>
                            </tr>
                            <tr>
                                <td>ເບີໂທລະສັບ 22233344, 55566677</td>
                                <td></td>
                                <td>@if($end_date != '') ເຖິງວັນທີ: {{ Carbon\Carbon::parse($end_date)->format('d-m-Y') }} @endif</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
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
                                <th style="width: 100px;">ວັນທີ</th>
                                <th style="width: 50px;">ເລກບິນ</th>
                                <th style="width: 100px;">ລູກຄ້າ</th>
                                <th style="width: 200px;">ເບີໂທລະສັບ</th>
                                <th>ລາຍການຂາຍ</th>
                                <th>ຜູ້ຂາຍ</th>
                                <th>ອັດຕາແລກປ່ຽນ</th>
                                <th>ຈຳນວນ</th>
                                <th>ລາຄາ</th>
                                <th>ລວມລາຍຮັບ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $total = 0; ?>
                            @forelse($sales as $sale)
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ $sale->id }}</td>
                                    <td>{{ $sale->customer_name }}</td>
                                    <td>{{ $sale->mobile1 }} {{ $sale->mobile2 }}</td>
                                    <td>{{ $sale->product_name }}</td>
                                    <td>{{ $sale->user_name }}</td>
                                    <td>{{ $sale->bill_rate }}</td>
                                    <td>{{ $sale->amount }}</td>
                                    <td>{{ number_format($sale->price) }}</td>
                                    <td>{{ number_format($sale->amount * $sale->price) }}</td>
                                    <?php $total += $sale->amount * $sale->price; ?>
                                </tr>
                            @empty
                                <tr><td colspan="11" style="color: red;">ຍັງບໍ່ມີລາຍການຂາຍ</td></tr>
                            @endforelse
                            <tr><td colspan="10" style="text-align: center;">ລວມ</td><td>{{ number_format($total) }}</td></tr>
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