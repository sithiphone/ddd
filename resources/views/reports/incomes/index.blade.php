@extends('layouts.app')

@section('content')
    <div class="container" style="width: 1360px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍງານລາຍຮັບ
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <fieldset>
                                <div class="col-md-1"><br />
                                    <label><input @if($sel_on == 1) checked @endif type="radio" name="on" value="1"> ປະຈຳວັນ</label>
                                </div>
                                <div class="col-md-1"><br />
                                    <label><input @if($sel_on == 2) checked @endif type="radio" name="on" value="2"> ປະຈຳເດືອນ</label>
                                </div>
                                <div class="col-md-1"><br />
                                    <label><input @if($sel_on == 3) checked @endif type="radio" name="on" value="3"> ປະຈຳປີ</label>
                                </div>
                                <div class="col-md-2">
                                    ແຕ່ວັນທີ: <input type="date" name="from_date" value="{{ $from_date }}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    ຫາວັນທີ: <input type="date" name="to_date" value="{{ $to_date }}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <br />
                                    <select class="form-control" name="sel_status">
                                        <option value="*">--- ທຸກສະຖານະ ---</option>
                                        @foreach($billstatus as $status)
                                            <option value="{{ $status->id }}"
                                            @if($sel_status == $status->id)
                                                {{ 'selected="selected"' }}
                                                    @endif
                                            >{{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <br />
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
                            <th>ລູກຄ້າ</th>
                            <th>ລາຍຮັບ</th>
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
                                <td>{{ $income->status }}</td>
                            </tr>
                            <?php $saletotal += $income->total; ?>
                        @empty
                            <tr><td colspan="7" style="color: red;">ບໍ່ມີລາຍການຂາຍໃນໃບບິນ</td></tr>
                        @endforelse
                        <tr><td colspan="4" style="text-align: center;">ລວມລາຍຮັບ</td><td>{{ number_format($saletotal) }}</td><td></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{--ລາຍຮັບແບບຂຽນບິນ--}}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍງານລາຍຮັບແບບຂຽນບິນ
                    </div>

                    <table class="table tatble-hover">
                        <thead>
                        <tr>
                            <th>ລຳດັບ</th>
                            <th>ວັນທີ</th>
                            <th>ເລກທີໃບບິນ</th>
                            <th>ລູກຄ້າ</th>
                            <th>ລາຍຮັບ</th>
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
                                <td>{{ $income->status }}</td>
                            </tr>
                            <?php $billtotal += $income->total; ?>
                        @empty
                            <tr><td colspan="7" style="color: red;">ບໍ່ມີລາຍການຂາຍໃນໃບບິນ</td></tr>
                        @endforelse
                        <tr><td colspan="4" style="text-align: center;">ລວມລາຍຮັບ</td><td>{{ number_format($billtotal) }}</td><td></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{--ລວມລາຍຮັບທັງໝົດ--}}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລວມລາຍຮັບທັງໝົດ = ການຂາຍ + ຂຽນບິນເອງ
                    </div>

                    <table class="table tatble-hover">
                        <thead>
                        <tr>
                            <th>ລາຍຮັບຈາກການຂາຍ</th>
                            <th>ລາຍຮັບຈາກການຂຽນບິນເອງ</th>
                            <th>ລວມລາຍຮັບທັງໝົດ</th>
                        </tr>
                        </thead>
                        <tbody>
                            <td>{{ number_format($saletotal) }}</td>
                            <td>{{ number_format($billtotal) }}</td>
                            <td>{{ number_format($saletotal + $billtotal) }}</td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection()