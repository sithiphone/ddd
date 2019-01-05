@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">3D Printing & Sign</div>
                    <div class="col-md-6">ຜະລິດ ແລະ ຈຳໜ່າຍ ງານໂຄສະນາ ແລະ ປ້າຍທຸກຊະນິດ ແບບຄົວວົງຈອນ ຮັບເໝົາງານໂຄງເຫຼັກໃຫຍ່, ງານສະແຕນເລດສ, ປ້າຍໂຄສະນາໃຫຍ່<br />
                        ບ.ໂພນສະຫວາດເໜືອ, ມ.ສີໂຄດຕະບອງ, ນະຄອນຫຼວງວຽງຈັນ<br />
                        Tel/Fax: 021-670929, 020 55702429, 020 55008749</div>

                    <div class="col-md-10 col-md-offset-1">
                        <?php $no = 1; $total = 0; $total_kip = 0;?>
                        <form action="{{url("madeBill")}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="cus_id" value="{{$customer->id}}">
                            <input type="hidden" name="bill_type" value="1">
                            <input type="submit" value="ສ້າງລາຍການຂາຍ" class="btn btn-primary pull-right">

                            <table class="table table-bordered billtable">
                                <tbody>
                                <tr>
                                    <td colspan="7" style="font-size: 25px; text-align: center;">ໃບບິນຮັບເງິນ</td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="font-size: 20px; text-align: center;">Qoatation</td>
                                </tr>
                                <tr>
                                    <td colspan="5">ເລກທີ: <br />ເຖິງ:  {{ $customer->name }}<br />
                                        ເບີໂທລະສັບ: {{ $customer->mobile1 }}
                                        @if(null !== $customer->mobile2 and $customer->mobile2 != '')
                                            , {{ $customer->mobile2 }}
                                        @endif
                                    </td>
                                    <td colspan="2">ວັນທີ {{ \Carbon\Carbon::parse(now())->format('d/m/Y') }}</td>
                                </tr>
                                <tr style="background: #cccccc; text-align: center; font-weight: bold;">
                                    <td style="width: 50px;">ລ/ດ</td>
                                    <td style="width: 450px;">ລາຍລະອຽດ</td>
                                    <td style="width: 100px;">ຈ/ນ</td>
                                    <td style="width: 100px;">ຫ/ໜ</td>
                                    <td style="width: 150px;">ລາຄາ</td>
                                    <td style="width: 150px;">ລວມຍອດລາຄາ</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><textarea name="product[]" class="form-control"></textarea></td>
                                    <td><input type="number" name="quantity[]" value="" class="form-control"></td>
                                    <td><input type="text" name="unit[]" value="" class="form-control"></td>
                                    <td><input type="number" name="amount[]" value="" class="form-control"></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            <p id="addrow">+ ເພີ່ມລາຍການ</p>
                            <table class="table">
                                <tr>
                                    <td><label><input type="radio" name="curency" value="kip" checked="checked"> ກີບ</label></td>
                                    <td><label><input type="radio" name="curency" value="bath"> ບາດ</label></td>
                                    <td><label><input type="radio" name="curency" value="dolar"> ໂດລາ</label></td>
                                    <td><label><input type="radio" name="curency" value="erro"> ເອີໂຣ</label></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        ມັດຈຳເງິນ <input type="number" name="deposit" class="form-control" value="">
                                    </td>
                                    <td colspan="2">
                                        ລວມອາກອນ 10% <input type="checkbox" name="tax" class="form-control" value="1">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">ບ່ອນສົ່ງ:
                                        <input type="text" name="ship_place" value="" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>ໄລຍະຮັບປະກັນ: <label style="margin-left: 100px;"><input type="radio" name="warranty" value="1" checked="checked">1 ເດືອນ</label></td>
                                    <td><label><input type="radio" name="warranty" value="3">3 ເດືອນ</label></td>
                                    <td><label><input type="radio" name="warranty" value="6">6 ເດືອນ</label></td>
                                    <td><label><input type="radio" name="warranty" value="12">12 ເດືອນ</label></td>
                                </tr>
                                <tr>
                                    <td colspan="3">ກຳນົດສົ່ງສິນຄ້າ:
                                        <input type="date" name="ship_date" class="form-control">
                                    </td>
                                    <td colspan="3">ກຳນົດການຈ່່າຍເງິນ:
                                        <input type="date" name="pay_date" class="form-control">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()