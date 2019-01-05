@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ສ້າງໃບສະເໜີລາຄາ
                        <div class="pull-right">
                            <a href="{{ route('quotations.customer') }}" class="btn btn-primary">ເລືອກລູກຄ້າ</a>
                            <a href="{{ route('quotations.index') }}" class="btn btn-primary">ກັບຄືນ</a>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-md-8">
                        <form class="form-horizontal" action="{{ route('quotations.store') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <fieldset>
                                <!-- Text input-->
                                <div class="form-group"><div class="panel-body">
                                        <div class="col-md-12">
                                            <label class="col-md-1 control-label" for="code">ສິນຄ້າ</label>
                                            <div class="col-md-11">
                                                <input name="product" placeholder="ລາຍການສິນຄ້າ" type="text" class="productquotation form-control">
                                            </div>
                                        </div>
                                        <input type="hidden" id="route_product_for_quotation" val="{{ route('autocompleteQuotation') }}">
                                        <div class="col-md-12" style="margin-top: 5px;">
                                            <label class="col-md-1 control-label" for="code">ລາຍລະອຽດ</label>
                                            <div class="col-md-11">
                                                <textarea name="descript" class="form-control" placeholder="ອະທິບາຍລາຍລະອຽດສິນຄ້າເພີ່ມເຕີມ"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="margin-top: 5px; margin-left: 8px;">
                                            <label class="col-md-4 control-label" for="code">ຈຳນວນ</label>
                                            <div class="col-md-8">
                                                <input name="amount"  class="form-control input-md" type="number">
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="margin-top: 5px;">
                                            <label class="col-md-4 control-label">ຫົວໜ່ວຍ: </label>
                                            <div class="col-md-8">
                                                <select name="unit" class="form-control">
                                                    @foreach($units as $unit)
                                                        <option value="{{ $unit->unit_eng }}">{{ $unit->unit_lao }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 5px;">
                                            <label class="col-md-3 control-label">ລາຄາ</label>
                                            <div class="col-md-9">
                                                <input name="price"  class="form-control input-md" type="number">
                                            </div>
                                        </div>

                                        <div class="col-md-1" style="margin-top: 5px;">
                                            <button type="submit" name="button" value="SEARCH" class="btn btn-success pull-right">ເພີ່ມເຂົ້າ</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-md-4" style="background: #c4e3f3; height: 180px;">
                        <form action="{{ route('quotations.save') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            @if( null !== session('customer_name') and session('customer_name') != '')
                                <div class="col-md-12" style="margin-top: 5px;">
                                    <label class="col-md-6 control-label">ຊື່ລູກຄ້າ:</label>
                                    <div class="col-md-6" style="font-weight: bold;">
                                        {{ session('customer_name') }}
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12" style="margin-top: 5px;">
                                <label class="col-md-6 control-label">ລາຍການສະເໜີ</label>
                                <div class="col-md-6">
                                    <span style="font-weight: bold;">{{ count(session('quotations.list')) }} ລາຍການ.</span>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 5px;">
                                <label class="col-md-6 control-label">ລວມອາກອນ 10%</label>
                                <div class="col-md-6">
                                    <input name="tax" value="1" class="form-control" type="checkbox">
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <label class="col-md-6 control-label"></label>
                                <div class="col-md-6">
                                    <button class="btn btn-success">ບັນທຶກໃບສະເໜີລາຄາ</button>
                                </div>
                            </div>
                            <input type="hidden" name="button" value="save">
                        </form>
                    </div>


                    <hr />
                    <?php $no = 1; ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ລຳດັບ</th>
                                <th>ລາຍການ</th>
                                <th>ລາຍລະອຽດ</th>
                                <th>ຈຳນວນ</th>
                                <th>ລາຄາ</th>
                                <th style="width: 100px;">ລວມເປັນ</th>
                                <th>ລຶບ</th>
                            </tr>
                        </thead>
                        <?php $total = 0; ?>
                        @if(null != session('quotations.list'))
                            @forelse(session('quotations.list') as $key => $list)
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>{{ $list['product'] }}</td>
                                    <td>{{ $list['descript'] }}</td>
                                    <td>{{ $list['amount'] }}</td>
                                    <td>{{ number_format($list['price']) }}</td>
                                    <td>{{ number_format($list['price'] * $list['amount']) }}</td>
                                    <td>
                                        <form action="{{ route('quotations.store', ['del_item' => $key]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('POST') }}
                                            <button class="btn btn-danger">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $total += ($list['price'] * $list['amount']); ?>
                            @empty
                                ຍັງບໍ່ມີລາຍການໃນໃບສະເໜີລາຄາ
                            @endforelse
                            <tr>
                                <td colspan="5" style="text-align: center;">ລວມເປັນເງິນ</td>
                                <td>{{ number_format($total) }} ກີບ</td>
                                <td></td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection