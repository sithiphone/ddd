@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">ໝວດສິນຄ້າ</div>
                    <div class="panel-body">
                        <div class="pull-right" style="margin-bottom: 20px;">
                            <a class="btn btn-success" href="{{ route('categories.create') }}">ສ້າງໝວດສິນຄ້າໃໝ່</a>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <table class="table table-hover">
                            <tr>
                                <th>ລຳດັບ</th>
                                <th>ລະຫັດໝວດ</th>
                                <th>ໝວດສິນຄ້າ</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($categories as $key => $categorie)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $categorie->code }}</td>
                                    <td>{{ $categorie->name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('categories.edit',$categorie->id) }}">ແກ້ໄຂຂໍ້ມູນ</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST"
                                              style="display: inline;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" CLASS="btn btn-danger" onclick="return confirm('ຕ້ອງການລຶບແທ້ບໍ?')">ລຶບ</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $categories->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection