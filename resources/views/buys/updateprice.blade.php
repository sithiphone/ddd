@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        <form action="{{ route('buys.editPrice') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <input type="hidden" name="id" value="{{ $buy[0]->id }}">
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="4" style="font-size: 25px; text-align: center;">ຮັບເຄື່ອງເຂົ້າສາງໂຮງງານ</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="font-size: 20px; text-align: center;">Receive products</td>
                                </tr>
                                <tr>
                                    <td colspan="2">ເລກທີ: {{ $buy[0]->code }}<br />ສັ່ງຊື້ກັບ: {{ $buy[0]->supplier_name }}<br />
                                        ເບີໂທລະສັບ: {{ $buy[0]->mobile1 }}
                                        @if(null !== $buy[0]->mobile2 and $buy[0]->mobile2 != '')
                                            , {{ $buy[0]->mobile2 }}
                                        @endif
                                    </td>
                                    <td colspan="2">ວັນທີ {{ \Carbon\Carbon::parse($buy[0]->created_at)->format('d/m/Y') }}</td>
                                </tr>
                                <tr style="background: #e0e0e0; font-weight: bold;">
                                    <td>ລຳດັບ</td>
                                    <td>ລາຍການ</td>
                                    <td>ຈຳນວນ</td>
                                    <td>ລາຄາ</td>
                                </tr>
                                <tbody>
                                @if(null !== $buydetails)
                                    <?php $no = 1; $total = 0; $total_kip = 0;?>
                                    @foreach($buydetails as $item)
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td>{{ $item['name'] }}</td>
                                            <td><input type="number" class="form-control" name="amount[]" value="{{ $item['amount'] }}" style="width: 100px;"></td>
                                            <td><input type="number" class="form-control" name="price[]" value="{{ $item['price'] }}" style="width: 100px;"></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tr>
                                    <td colspan="4">
                                        <label style="margin-left: 100px;"><input type="radio" @if($buy[0]->status == 1) checked="checked" @endif class="form-control" name="status" value="1"> ສຳເລັດແລ້ວ</label>
                                        <label style="margin-left: 100px;"><input type="radio" @if($buy[0]->status == 0) checked="checked" @endif class="form-control" name="status" value="0"> ຍັງລໍຖ້າ</label>
                                        <button class="btn btn-primary pull-right" type="submit">ອັບເດດລາຄາ</button>
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