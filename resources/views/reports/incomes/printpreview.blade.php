@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 style="text-align: center; text-decoration: underline;">ລາຍງານລາຍຮັບ
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
                                <th>ລູກຄ້າ</th>
                                <th>ລາຍຮັບ</th>
                                <th>ປະເພດບິນ</th>
                                <th>ສະຖານະໃບບິນ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $saletotal = 0;?>
                            @forelse($incomes as $income)
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>{{ Carbon\Carbon::parse($income->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ $income->bill_id }}</td>
                                    <td>{{ $income->customer_name }}</td>
                                    <td>{{ number_format($income->total) }}</td>
                                    <td>ທົ່ວໄປ</td>
                                    <td>{{ $income->status }}</td>
                                </tr>
                                <?php $saletotal += $income->total; ?>
                            @empty
                                <tr><td colspan="7" style="color: red;">ບໍ່ມີລາຍການຂາຍໃນໃບບິນ</td></tr>
                            @endforelse
                            <tr><td colspan="4" style="text-align: center;">ລວມລາຍຮັບ</td><td>{{ number_format($saletotal) }}</td><td></td><td></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{--ແບບຂຽນບິນ--}}

                <div class="panel-body">
                    <div class="col-md-11 col-md-offset-1">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ລຳດັບ</th>
                                <th>ວັນທີ</th>
                                <th>ເລກທີໃບບິນ</th>
                                <th>ລູກຄ້າ</th>
                                <th>ລາຍຮັບ</th>
                                <th>ປະເພດບິນ</th>
                                <th>ສະຖານະໃບບິນ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $billtotal = 0;?>
                            @forelse($madebills as $income)
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>{{ Carbon\Carbon::parse($income->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ $income->bill_id }}</td>
                                    <td>{{ $income->customer_name }}</td>
                                    <td>{{ number_format($income->total) }}</td>
                                    <td>ຂຽນບິນເອງ</td>
                                    <td>{{ $income->status }}</td>
                                </tr>
                                <?php $billtotal += $income->total; ?>
                            @empty
                                <tr><td colspan="7" style="color: red;">ບໍ່ມີລາຍການຂາຍໃນໃບບິນ</td></tr>
                            @endforelse
                            <tr><td colspan="4" style="text-align: center;">ລວມລາຍຮັບ</td><td>{{ number_format($billtotal) }}</td><td></td><td></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-11 col-md-offset-1">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ລາຍຮັບການຂາຍ</th>
                                <th>ລາຍຮັບຂຽນບິນ</th>
                                <th>ລວມລາຍຮັບທັງໝົດ</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ number_format($saletotal) }}</td>
                                    <td>{{ number_format($billtotal) }}</td>
                                    <td>{{ number_format($saletotal + $billtotal) }}</td>
                                </tr>
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