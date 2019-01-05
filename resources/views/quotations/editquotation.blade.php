@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                        <?php $no = 1; $total = 0; $total_kip = 0; ?>
                        <form action="{{ route('quotations.update', ['id'=>$quotation->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td colspan="6" style="font-size: 25px; text-align: center;">ແກ້ໄຂຂໍ້ມູນໃບສະເໜີລາຄາ</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="font-size: 20px; text-align: center;">Qoatation</td>
                                </tr>
                                <tr>
                                    <td colspan="3">ເລກທີ: {{ $quotation->code }}<br />ເຖິງ:  {{ $quotation->customer_name }}<br />
                                        ເບີໂທລະສັບ: {{ $quotation->mobile1 }}
                                        @if(null !== $quotation->mobile2 and $quotation->mobile2 != '')
                                            , {{ $quotation->mobile2 }}
                                        @endif
                                    </td>
                                    <td colspan="2">ວັນທີ {{ \Carbon\Carbon::parse($quotation->created_at)->format('d/m/Y') }}</td>
                                </tr>
                                <tr style="background: #cccccc; text-align: center; font-weight: bold;">
                                    <td>ລ/ດ</td>
                                    <td style="width: 400px;">ລາຍການ</td>
                                    <td>ລາຍລະອຽດ</td>
                                    <td style="width: 80px;">ຈ/ນ</td>
                                    <td style="width: 100px;">ຫ/ໜ</td>
                                    <td style="width: 130px;">ລາຄາ</td>
                                </tr>
                                @foreach($quotations as $item)
                                    <input type="hidden" name="item_id[]" value="{{ $item->id }}">
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td><textarea name="item[]" class="form-control">{{ $item->item }}</textarea></td>
                                        <td><textarea name="descript[]" class="form-control">{{ $item->descript }}</textarea></td>
                                        <td><input type="number" name="amount[]" value="{{ $item->amount }}" class="form-control"> </td>
                                        <td>
                                            <select name="unit[]" class="form-control">
                                            @foreach($units as $unit)
                                                @if($unit->unit_eng == $item->unit)
                                                    <option selected="selected" value="{{ $unit->unit_eng }}">{{ $unit->unit_eng }}</option>
                                                @else
                                                    <option value="{{ $unit->unit_eng }}">{{ $unit->unit_eng }}</option>
                                                @endif
                                            @endforeach
                                            </select></td>
                                        <td><input type="number" name="price[]" value="{{ $item->price }}" class="form-control"></td>
                                    </tr>
                                    <?php
                                    $no++;
                                    $total += ($item->price * $item->amount);
                                    ?>
                                @endforeach
                                <!-- include tax 10% -->
                                @if($quotation->tax == 1)
                                    <tr>
                                        <td colspan="5" style="text-align: center;"># ອາກອນ 10%</td>
                                        <td><input type="checkbox" name="tax[]" value="1" checked class="form-control"></td>
                                    </tr>
                                @else <!-- exclude tax 10% -->
                                    <tr>
                                        <td colspan="5" style="text-align: center;"># ອາກອນ 10%</td>
                                        <td><input type="checkbox" name="tax[]" value="1" checked class="form-control"></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="6">
                                        <button type="submit" name="button" value="SUBMIT" class="btn btn-success pull-right">ປັບປຸງຂໍ້ມູນ</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()