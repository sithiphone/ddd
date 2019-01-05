@extends('layouts.app')

@section('content')
    <div class="container" style="width: 1360px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍງານລາຍການສິນຄ້າ
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <fieldset>
                                <div class="col-md-2" style="margin-bottom: 10px;">
                                    <input type="text" name="code" value="{{ $code }}" class="form-control" placeholder="ລະຫັດ" >
                                </div>
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <input type="text" name="searchtext" value="{{ $searchtext }}" class="form-control" placeholder="ຄົ້ນຫາສິນຄ້າ" >
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="sel_category">
                                        <option value="*">--- ທຸກໝວດສິນຄ້າ ---</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                            @if($sel_category == $category->id)
                                                {{ 'selected="selected"' }}
                                                    @endif
                                            >{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="button" value="SEARCH" class="btn btn-success">ຄົ້ນຫາ</button>
                                    <button type="submit" name="button" value="PRINT" class="btn btn-primary">ສ້າງລາຍງານ</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <table class="table tatble-hover">
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
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
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
                                <td>{{ \Carbon\Carbon::parse($product->updated_at)->format('d-m-y') }}</td>
                                <td><a class="btn btn-info" href="{{ route('products.show',['product_id' => $product->id, 'from' => 'REPORT']) }}">ສະແດງລາຍລະອຽດ</a></td>
                            </tr>
                            @empty
                            <tr><td colspan="9" style="color: red;">ບໍ່ມີລາຍການສິນຄ້າໃນຖານຂໍ້ມູນ</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection()