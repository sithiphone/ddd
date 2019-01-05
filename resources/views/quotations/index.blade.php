@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ໃບສະເໜີລາຄາ
                        <div class="pull-right"><a href="{{ route('quotations.create') }}" class="btn btn-primary">ສ້າງໃບສະເໜີລາຄາ</a> </div>
                    </div>
                    <form class="form-horizontal">
                        <fieldset>
                            <!-- Text input-->
                            <div class="form-group"><div class="panel-body">
                                    <div class="col-md-2">
                                        <label class="col-md-3 control-label" for="code">ລະຫັດ</label>
                                        <div class="col-md-9">
                                            <input id="code" name="code" placeholder="ລະຫັດ" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-md-3 control-label" for="code">ລູກຄ້າ</label>
                                        <div class="col-md-9">
                                            <input id="cus_name" name="customer_name" placeholder="ຊື່ລູກຄ້າ" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-md-3 control-label" for="code">ຕັ້ງແຕ່</label>
                                        <div class="col-md-9">
                                            <input id="from_date" name="from_date"  class="form-control input-md" type="date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-md-3 control-label" for="code">ເຖິງ</label>
                                        <div class="col-md-9">
                                            <input id="to_date" name="to_date"  class="form-control input-md" type="date">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="submit" name="button" value="SEARCH" class="btn btn-success">ຄົ້ນຫາ</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <div class="pull-right" style="font-size: 20px;">ລາຍການໃບສະເໜີທັງໝົດມີ {{ $totals }} ລາຍການ.</div>
                    <hr />
                    <?php $no = 1; ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ລຳດັບ</th>
                                <th>ເລກທີ</th>
                                <th>ລູກຄ້າ</th>
                                <th>ສ້າງວັນທີ</th>
                                <th>ແກ້ໄຂວັນທີ</th>
                                <th>ເບິ່ງລາຍລະອຽດ</th>
                                <th>ແກ້ໄຂ</th>
                                <th>ລຶບ</th>
                            </tr>
                        </thead>
                        @forelse($quotations as $quotation)
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>{{ $quotation->code }}</td>
                                <td>{{ $quotation->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($quotation->created_at)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($quotation->updated_at)->format('d-m-Y') }}</td>
                                <td><a href="{{ route('quotations.show', ['id' => $quotation->id]) }}" class="btn btn-primary">ເບິ່ງລາຍລະອຽດ</a></td>
                                <td><a href="{{ route('quotations.edit', ['id' => $quotation->id]) }}" class="btn btn-success">ແກ້ໄຂ</a></td>
                                <td>
                                    <form action="{{ route('quotations.destroy', ['id' => $quotation->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('ຕ້ອງການລຶບແທ້ບໍ?')">ລຶບ</button>
                                    </form>
                            </tr>
                            @empty
                            <tr><td style="color: red;" colspan="8">ບໍ່ມີລາຍການໃບສະເໜີລາຄາ</td></tr>
                        @endforelse
                    </table>
                </div>
                {{ $quotations->links() }}
            </div>
        </div>
    </div>
@endsection