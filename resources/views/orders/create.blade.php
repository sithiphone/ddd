@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="pull-right" style="margin-right: 100px;">
            <a href="{{ route('orders.printPreview', ['curency' => Session::get('curency')]) }}" class="btnPrint btn btn-primary">Print preview</a>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 style="text-align: center; text-decoration: underline;">ໃບບິນຮັບເງິນ</h2>
                    <p>&nbsp;</p>
                    <div class="col-md-10 col-md-offset-1">
                        <table>
                            <tbody>
                            <tr>
                               <td style="font-size: 20px;">ຮ້ານ ສາມດີ</td>
                               <td style="width: 270px;"></td>
                               <td >ເລກທີ: {{ $last_bill }}</td>
                            </tr>
                            <tr>
                                <td>ຖະໜົນທົ່ງປົ່ງ, ປ້ານ ທົ່ງປົ່ງ, ເມືອງ ສີໂຄດຕະບອງ, ແຂວງນະຄອນຫຼວງວຽງຈັນ</td>
                                <td></td>
                                <td>ຜູ້ຊື້: {{ session('customerName') }}</td>
                            </tr>
                            <tr>
                                <td>ເບີໂທລະສັບ 22233344, 55566677</td>
                                <td></td>
                                <td>ເບີໂທລະສັບ: {{ session('customerMobile1') }}
                                    @if(null !== session('customerMobile2') and session('customerMobile2') != '')
                                        , {{ session('customerMobile2') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ລຳດັບ</th>
                                <th>ລາຍການ</th>
                                <th>ຕາແມັດ</th>
                                <th>ຈຳນວນ</th>
                                <th>ລາຄາ</th>
                                <th>ເປັນເງິນ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(null !== Session::get('order.items'))
                                <?php $no = 1; $total = 0; $total_kip = 0;?>
                                @foreach(Session::get('order.items') as $item)
                                        @if(in_array($item['product_id'], $products))
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $item['product_name'] }}</td>
                                                <td>{{ $item['amount'] }}</td>
                                                <td></td>
                                                <td>{{ number_format($item['product_price'] / $rate) }}</td>
                                                <td>{{ number_format(($item['product_price'] / $rate) * $item['amount']) }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $item['product_name'] }}</td>
                                                <td></td>
                                                <td>{{ $item['amount'] }}</td>
                                                <td>{{ number_format($item['product_price'] / $rate) }}</td>
                                                <td>{{ number_format(($item['product_price'] / $rate) * $item['amount'])}}</td>
                                            </tr>
                                        @endif
                                    <?php
                                    $no++;
                                    $total += (($item['product_price'] / $rate) * $item['amount']);
                                    $total_kip += ($item['product_price'] * $item['amount']);
                                    ?>
                                @endforeach
                                <tr>
                                    <td colspan="5" style="text-align: center;">ລວມ</td>
                                    <td>{{ number_format($total) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right;">ເປັນເງິນກີບ</td>
                                    <td>{{ number_format($total_kip / 1) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right;">ເປັນເງິນບາດ</td>
                                    <td>{{ number_format($total_kip / $rates->bath) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right;">ເປັນເງິນໂດລາ</td>
                                    <td>{{ number_format($total_kip / $rates->dolar) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right;">ເປັນເງິນເອີໂຣ</td>
                                    <td>{{ number_format($total_kip / $rates->erro) }}</td>
                                </tr>
                            @endif
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
                                <td>{{ session('customerName') }}</td>
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