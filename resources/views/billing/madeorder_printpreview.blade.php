@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">3D Printing & Sign</div>
                    <div class="col-md-6">ຜະລິດ ແລະ ຈຳໜ່າຍ ງານໂຄສະນາ ແລະ ປ້າຍທຸກຊະນິດ ແບບຄົວວົງຈອນ ຮັບເໝົາງານໂຄງເຫຼັກໃຫຍ່, ງານສະແຕນເລດສ, ປ້າຍໂຄສະນາໃຫຍ່<br />
                        ບ.ໂພນສະຫວາດເໜືອ, ມ.ສີໂຄດຕະບອງ, ນະຄອນຫຼວງວຽງຈັນ<br />
                        Tel/Fax: 021-670929, 020 55702429, 020 55008749</div>

                    <div class="col-md-10 col-md-offset-1">
                        <?php $no = 1; $total = 0; $total_kip = 0;?>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td colspan="7" style="font-size: 25px; text-align: center;">ໃບບິນຮັບເງິນ</td>
                            </tr>
                            <tr>
                                <td colspan="7" style="font-size: 20px; text-align: center;">Qoatation</td>
                            </tr>
                            <tr>
                                <td colspan="5">ເລກທີ: {{ $bill_id }}<br />ເຖິງ:  {{ $customer->name }}<br />
                                    ເບີໂທລະສັບ: {{ $customer->mobile1 }}
                                    @if(null !== $customer->mobile2 and $customer->mobile2 != '')
                                        , {{ $customer->mobile2 }}
                                    @endif
                                </td>
                                <td colspan="2">ວັນທີ {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</td>
                            </tr>
                            <tr style="background: #cccccc; text-align: center; font-weight: bold;">
                                <td>ລ/ດ</td>
                                <td style="width: 300px;">ລາຍລະອຽດ</td>
                                <td>ຈ/ນ</td>
                                <td>ຈ/ນm</td>
                                <td>ຫ/ໜ</td>
                                <td>ລາຄາ</td>
                                <td>ລວມຍອດລາຄາ</td>
                            </tr>
                            @foreach($sales as $item)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $item->product }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td></td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ number_format($item->price / $rate) }}</td>
                                    <td>{{ number_format(($item->price / $rate) * $item->amount) }}</td>
                                </tr>
                                <?php
                                $no++;
                                $total += (($item->price / $rate) * $item->amount);
                                $total_kip += ($item->price * $item->amount);
                                ?>
                            @endforeach
                            <!-- include tax 10% -->
                            @if($bill->tax == 1)
                                <tr>
                                    <td colspan="6" style="text-align: center;"># ອາກອນ 10%</td>
                                    <td>{{ number_format(($total * 10)/100) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: center;">ລວມ</td>
                                    <td>{{ number_format((($total) + ($total * 10)/100)) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right;">ເປັນເງິນກີບ</td>
                                    <td>{{ number_format(($total_kip + (($total_kip * 10)/100)) / 1) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right;">ເປັນເງິນບາດ</td>
                                    <td>{{ number_format(($total_kip + (($total_kip * 10)/100)) / $rates->bath) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right;">ເປັນເງິນໂດລາ</td>
                                    <td>{{ number_format(($total_kip + (($total_kip * 10)/100)) / $rates->dolar) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right;">ເປັນເງິນເອີໂຣ</td>
                                    <td>{{ number_format(($total_kip + (($total_kip * 10)/100)) / $rates->erro) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">ມັດຈຳໄວ້: {{ number_format($bill->deposit) }}</td>
                                    <td colspan="4">ຍອດຄ້າງຊຳລະ: {{ number_format((($total_kip) + ($total_kip * 10)/100) - $bill->deposit) }}</td>
                                    <td></td>
                                </tr>
                            @else <!-- exclude tax 10% -->
                            <tr>
                                <td colspan="6" style="text-align: center;">ລວມ</td>
                                <td>{{ number_format($total) }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align: right;">ເປັນເງິນກີບ</td>
                                <td>{{ number_format($total_kip / 1) }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align: right;">ເປັນເງິນບາດ</td>
                                <td>{{ number_format($total_kip / $rates->bath) }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align: right;">ເປັນເງິນໂດລາ</td>
                                <td>{{ number_format($total_kip / $rates->dolar) }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align: right;">ເປັນເງິນເອີໂຣ</td>
                                <td>{{ number_format($total_kip / $rates->erro) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">ມັດຈຳໄວ້: {{ number_format($bill->deposit) }}</td>
                                <td colspan="4">ຍອດຄ້າງຊຳລະ: {{ number_format($total - $bill->deposit) }}</td>
                                <td></td>
                            </tr>
                            @endif

                            <tr>
                                <td colspan="7">
                                    ສົ່ງ: {{ $bill->ship_place }}<br />
                                    ໄລຍະຮັບປະກັນ: {{ $bill->warranty }} ເດືອນ<br />
                                    ກຳນົດສົ່ງສິນຄ້າ: {{ \Carbon\Carbon::parse($bill->ship_date)->format('d/m/Y') }}
                                    <span style="margin-left: 200px">ກຳນົດການຈ່າຍເງິນ: {{ \Carbon\Carbon::parse($bill->pay_date)->format('d/m/Y') }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                        <table style="width: 100%;">
                            <thead>
                            <tr><td colspan="3" style="color: red;">
                                    <span style="font-weight: bold">ໝາຍເຫດ: </span> ກໍລະນີລູກຄ້າຕ້ອງການຍົກເລີກຫຼັງຈາກອອກໃບບິນແລ້ວ ລູກຄ້າຕ້ອງຮັບຜິດຊອບຄ່າໃຊ້ຈ່າຍເປັນຈຳນວນ 50% ຂອງມູນຄ່າ ໃນໃບບິນທັງໝົດ.
                                </td></tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>ຜູ້ຈ່າຍເງິນ</td>
                                <td style="width: 240px;">ຜູ້ຮັບເງິນ</td>
                                <td>ຫົວໜ້າການເງິນ</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ Auth::user()->name }}</td>
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