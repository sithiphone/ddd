@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ເລືອກລູກຄ້າ [ໃບສະເໜີລາຄາ]
                        <div class="pull-right"><a href="{{ route('quotations.create') }}" class="btn btn-primary">ກັບຄືນ</a> </div>
                    </div>
                    <form class="form-horizontal" action="{{ route('quotations.customer') }}" method="GET">
                        {{ csrf_field() }}
                        {{ method_field('GET') }}
                        <fieldset>
                            <!-- Text input-->
                            <div class="form-group"><div class="panel-body">
                                        <div class="col-md-5">
                                            <label class="col-md-3 control-label" for="code">ຄົ້ນຫາດ້ວຍຊື່ລູກຄ້າ</label>
                                            <div class="col-md-9">
                                                <input id="cus_name" name="customer_name" placeholder="ຊື່ລູກຄ້າ" class="form-control input-md" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-3 control-label" for="code">ເບີໂທລະສັບ</label>
                                            <div class="col-md-9">
                                                <input id="cus_mobile" name="customer_mobile" placeholder="ເບີໂທລະສັບ" class="form-control input-md" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" name="button" value="SEARCH" class="btn btn-success">ຄົ້ນຫາ</button>
                                        </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <hr />
                    <?php $no = 1; ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ລຳດັບ</th>
                                <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                                <th>ເບີໂທລະສັບ1</th>
                                <th>ເບີໂທລະສັບ2</th>
                                <th>ອີເມວ</th>
                                <th></th>
                            </tr>
                        </thead>
                        @forelse($customers as $cus)
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>{{ $cus->name }}</td>
                                <td>{{ $cus->mobile1 }}</td>
                                <td>{{ $cus->mobile2 }}</td>
                                <td>{{ $cus->email }}</td>
                                <td><a href="{{ route('quotations.selected', ['cus_name' => $cus->name, 'cus_id'=> $cus->id]) }}" class="btn btn-success">ເລືອກເອົາ</a> </td>
                            </tr>
                            @empty
                            ບໍ່ມີລາຍການລູກຄ້າໃນຖານຂໍ້ມູນ
                        @endforelse
                    </table>
                </div>
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection