@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ລາຍການຂໍ້ມູນສິນຄ້າ
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('products.create') }}">ເພີ່ມສິນຄ້າ</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="GET" action="/products" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <fieldset>
                                <div class="col-md-10">
                                    <select class="form-control" name="sel_category" onchange="form.submit()">
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
                                <div class="col-md-10" style="margin-bottom: 10px;">
                                    <input type="text" name="searchtext" class="form-control" value="{{ $search_text }}" placeholder="ຄົ້ນຫາສິນຄ້າ" >
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" name="button" value="SEARCH" class="btn btn-success">ຄົ້ນຫາ</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ລະຫັດສິນຄ້າ</th>
                            <th>ໝວດ</th>
                            <th>ລາຍການສິນຄ້າ</th>
                            <th>ລາຄາສິນຄ້າ</th>
                            <th>ຮູບສິນຄ້າ</th>
                            <th style="width: 150px;"></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->cat_name }}</td>
                                <td style="width: 400px;">{{ $product->name }}</td>
                                <td>{{ number_format($product->price) }}</td>
                                @if($product->photo != '')
                                    <td><img src="{{ asset("/storage/photos/products/$product->photo") }}"  style="height: 100px;"/></td>
                                @else
                                    <td><img src="{{ asset('/storage/photos/products/no_photo.jpg') }}" style="height: 100px;"/></td>
                                @endif
                                <td style="width: 200px;">
                                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">ສະແດງລາຍລະອຽດ</a>
                                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">ແກ້ໄຂ</a>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('products.destroy', $product->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('ຕ້ອງການລຶບແທ້ບໍ?')">ລຶບ</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            ບໍ່ມີລາຍການສິນຄ້າໃນຖານຂໍ້ມູນ
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection()
<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.closest('form').submit();
            }
        });
    });
</script>