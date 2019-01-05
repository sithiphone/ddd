@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="pull-right">
                    <a href="{{ route('reports.buys.printpreview', [
                    'button' => 'PRINT',
                    'code' => $code,
                    'supplier_name' => $supplier_name,
                    'user_name' => $user_name,
                    'status' => $status]) }}" class="btnPrint btn btn-primary" >Print preview</a>
                </div>
                <div class="panel-body">
                    <h2 style="text-align: center; text-decoration: underline;">ລາຍງານໃບສັ່ງຊື້</h2>
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
                                <th>ລະຫັດ</th>
                                <th>ສະເໜີວັນທີ</th>
                                <th>ຜຸ້ສະໜອງ</th>
                                <th>ຜູ້ສັ່ງຊື້</th>
                                <th>ສະຖານະ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach ($buys as $key => $buy)
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td>{{ $buy->code }}</td>
                                    <td>{{ \Carbon\Carbon::parse($buy->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ $buy->supplier_name }}</td>
                                    <td>{{ $buy->name }}</td>
                                    <td><?php if($buy->status == 1){echo "ຮັບເຄື່ງແລ້ວ";}else{ echo "ລໍຖ້າເຄື່ອງ";  } ?></td>
                                </tr>
                            @endforeach
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