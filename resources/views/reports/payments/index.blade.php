@extends('layouts.app')

@section('content')
    <div class="container" style="width: 1360px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍງານລາຍຈ່າຍ
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <fieldset>
                                <div class="col-md-2">
                                    <label><input  @if($sel_on == 1) checked @endif type="radio" name="on" value="1"> ປະຈຳວັນ</label>
                                </div>
                                <div class="col-md-2">
                                    <label><input @if($sel_on == 2) checked @endif type="radio" name="on" value="2"> ປະຈຳເດືອນ</label>
                                </div>
                                <div class="col-md-2">
                                    <label><input @if($sel_on == 3) checked @endif type="radio" name="on" value="3"> ປະຈຳປີ</label>
                                </div>
                                <div class="col-md-2">
                                    ແຕ່ວັນທີ: <input type="date" name="from_date" value="{{ $from_date }}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    ຫາວັນທີ: <input type="date" name="to_date" value="{{ $to_date }}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="button" value="FILTER" class="btn btn-primary">ກອງຂໍ້ມູນ</button>
                                    <button type="submit" name="button" value="PRINT" class="btn btn-primary">ເບິ່ງລາຍງານ</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <table class="table tatble-hover">
                        <thead>
                        <tr>
                            <th>ລຳດັບ</th>
                            <th>ວັນທີ</th>
                            <th>ເລກທີໃບບິນ</th>
                            <th>ຜູ້ສັ່ງຈ່າຍ</th>
                            <th>ລວມລາຍຈ່າຍ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; $total = 0;?>
                        @forelse($payments as $payment)
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>{{ Carbon\Carbon::parse($payment->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $payment->buy_id }}</td>
                                <td>{{ $payment->user_name }}</td>
                                <td>{{ number_format($payment->payamount) }}</td>
                            </tr>
                            <?php $total += $payment->payamount; ?>
                        @empty
                            <tr><td colspan="5" style="color: red;">ບໍ່ມີລາຍການຂາຍໃນໃບບິນ</td></tr>
                        @endforelse
                        <tr><td colspan="4" style="text-align: center;">ລວມລາຍຮັບ</td><td>{{ number_format($total) }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection()