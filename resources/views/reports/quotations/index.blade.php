@extends('layouts.app')

@section('content')
    <div class="container" style="width: 1360px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍງານໃບສະເໜີລາຄາ
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
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
                    </div>
                    <table class="table tatble-hover">
                        <thead>
                        <tr>
                            <th>ລຳດັບ</th>
                            <th>ວັນທີ</th>
                            <th>ເລກທີໃບສະເໜີ</th>
                            <th>ຜູ້ອອກສະເໜີ</th>
                            <th>ລູກຄ້າ</th>
                            <th>ແກ້ໄຂຫຼ້າສຸດ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
                        @forelse($quotations as $quotation)
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>{{ Carbon\Carbon::parse($quotation->created_at)->format('d-m-Y') }}</td>
                            <td>{{ $quotation->code }}</td>
                            <td>{{ Auth::user()->name }}</td>
                            <td>{{ $quotation->name }}</td>
                            <td>{{ Carbon\Carbon::parse($quotation->updated_at)->format('d-m-Y') }}</td>
                            <td><a href="{{ route('quotations.show', ['id' => $quotation->id]) }}" class="btn btn-primary">ເບິ່ງລາຍລະອຽດ</a></td>
                        </tr>
                            @empty
                            <tr><td style="color: red;" colspan="7">ບໍ່ມີລາຍການໃບສະເໜີລາຄາ</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection()