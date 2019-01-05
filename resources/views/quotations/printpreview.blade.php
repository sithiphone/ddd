@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">3D Printing & Sign</div>
                    <div class="col-md-6">ຜະລິດ ແລະ ຈຳໜ່າຍ ງານໂຄສະນາ ແລະ ປ້າຍທຸກຊະນິດ ແບບຄົວວົງຈອນ ຮັບເໝົາງານໂຄງເຫຼັກໃຫຍ່, ງານສະແຕນເລດສ, ປ້າຍໂຄສະນາໃຫຍ່<br />
                        ບ.ໂພນສະຫວາດເໜືອ, ມ.ສີໂຄດຕະບອງ, ນະຄອນຫຼວງວຽງຈັນ<br />
                        Tel/Fax: 021-670929, 020 55702429, 020 55008749</div><div class="col-md-10 col-md-offset-1">
                        <?php $no = 1; $total = 0; $total_kip = 0; ?>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td colspan="7" style="font-size: 25px; text-align: center;">ໃບສະເໜີລາຄາ</td>
                            </tr>
                            <tr>
                                <td colspan="7" style="font-size: 20px; text-align: center;">Qoatation</td>
                            </tr>
                            <tr>
                                <td colspan="5">ເລກທີ: {{ $quotation[0]->quo_code }}<br />ເຖິງ:  {{ $quotation[0]->customer_name }}<br />
                                    ເບີໂທລະສັບ: {{ $quotation[0]->mobile1 }}
                                    @if(null !== $quotation[0]->mobile2 and $quotation[0]->mobile2 != '')
                                        , {{ $quotation[0]->mobile2 }}
                                    @endif
                                </td>
                                <td colspan="2">ວັນທີ {{ \Carbon\Carbon::parse($quotation[0]->created_at)->format('d/m/Y') }}</td>
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
                            @foreach($quotations as $item)
                                @if($item->unit == 'mxm')
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $item->item }} [ {{ $item->descript }} ]</td>
                                        <td></td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->unit }}</td>
                                        <td>{{ number_format($item->price) }}</td>
                                        <td>{{ number_format($item->price * $item->amount) }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $item->item }} [ {{ $item->descript }} ]</td>
                                        <td>{{ $item->amount }}</td>
                                        <td></td>
                                        <td>{{ $item->unit }}</td>
                                        <td>{{ number_format($item->price) }}</td>
                                        <td>{{ number_format($item->price * $item->amount) }}</td>
                                    </tr>
                                @endif

                                <?php
                                $no++;
                                $total += ($item->price * $item->amount);
                                $total_kip += ($item->price * $item->amount);
                                ?>
                            @endforeach
                            <!-- include tax 10% -->
                            @if($quotation[0]->tax == 1)
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
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                        <table style="width: 100%;">
                            <thead>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="width: 200px;"></td>
                                <td style="width: 200px;"></td>
                                <td>ອຳນວຍການບໍລິສັດ3ດີການພິມແລະປ້າຍ</td>
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
                                <td></td>
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