@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="pull-right">
            <a href="{{ route('buys.printpreview', ['buy_id' => $buy[0]->id]) }}" class="btnPrint btn btn-primary" style="margin-right: 100px;">Print preview</a>
        </div>
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
                                <td colspan="3" style="font-size: 25px; text-align: center;">ໃບບິນຮັບເງິນ</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="font-size: 20px; text-align: center;">Qoatation</td>
                            </tr>
                            <tr>
                                <td colspan="2">ເລກທີ: {{ $buy[0]->code }}<br />ສັ່ງຊື້ກັບ: {{ $buy[0]->supplier_name }}<br />
                                    ເບີໂທລະສັບ: {{ $buy[0]->mobile1 }}
                                    @if(null !== $buy[0]->mobile2 and $buy[0]->mobile2 != '')
                                        , {{ $buy[0]->mobile2 }}
                                    @endif
                                </td>
                                <td colspan="1">ວັນທີ {{ \Carbon\Carbon::parse($buy[0]->created_at)->format('d/m/Y') }}</td>
                            </tr>
                            <tr style="background: #cccccc; text-align: center; font-weight: bold;">
                                <td>ລ/ດ</td>
                                <td style="width: 500px;">ລາຍການ</td>
                                <td style="width: 125px;">ຈຳນວນ</td>
                                @foreach($buydetails as $item)
                                    @if($item['price'] != '')
                                        <td>ລາຄາ</td>
                                        <td>ເປັນເງິນ</td>
                                        @break
                                    @endif
                                @endforeach
                            </tr>
                            @if(null !== $buydetails)
                                <?php $no = 1; $total = 0; ?>
                                @foreach($buydetails as $item)
                                    <tr>
                                        <td style="text-align: center;"><?php echo $no++; ?></td>
                                        <td>{{ $item['name'] }}</td>
                                        <td style="text-align: center;">{{ $item['amount'] }}</td>
                                        @if($item['price'] != '')
                                            <td>{{ number_format($item['price']) }}</td>
                                            <td>{{ number_format($item['amount'] * $item['price'])}}</td>
                                            <?php $total += ($item['amount'] * $item['price']); ?>
                                        @endif
                                    </tr>
                                @endforeach
                                @foreach($buydetails as $item)
                                    @if($item['price'] != '')
                                        <tr><td colspan="4" style="text-align: center;">ລວມ</td><td>{{ number_format($total) }}</td></tr>
                                        @break
                                    @endif
                                @endforeach
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
                                    <td style="width: 240px;"></td>
                                    <td style="width: 240px;"></td>
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