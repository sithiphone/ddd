@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-left: 10px; margin-right: 10px; width: 1360px;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 style="text-align: center; text-decoration: underline;">ລາຍງານລາຍການສິນຄ້າ</h2>
                    <p>&nbsp;</p>
                    <div class="col-md-10 col-md-offset-1">
                        <table>
                            <tbody>
                            <tr>
                               <td style="font-size: 20px;">ຮ້ານ ສາມດີ</td>
                               <td style="width: 270px;"></td>
                               <td>
                                   @if($code != '') ສຳລັບລະຫັດສິນຄ້າ: {{ $code }} @endif
                                   @if($cat_name != '') ສຳລັບໝວດສິນຄ້າ: {{ $cat_name }} @endif
                                   @if($product_name != '') ສຳລັບຊື່ສິນຄ້າ: {{ $product_name }} @endif
                               </td>
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
                                <th>ຮູບພາບ</th>
                                <th>ລະຫັດສິນຄ້າ</th>
                                <th style="width: 300px;">ຊື່ສິນຄ້າ</th>
                                <th>ໝວດສິນຄ້າ</th>
                                <th>ລາຄາ</th>
                                <th>ຈຳນວນ</th>
                                <th>ເພີ່ມເຂົ້າວັນທີ</th>
                                <th>ແກ້ໄຂວັນທີ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $total = 0; ?>
                            @forelse($products as $product)
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><img src="{{ asset("/storage/photos/products/$product->photo") }}" style="height: 100px;"> </td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->cat_name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->amount }}</td>
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($product->updated_at)->format('d-m-Y') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="9" style="color: red;">ບໍ່ມີລາຍການສິນຄ້າໃນຖານຂໍ້ມູນ</td></tr>
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