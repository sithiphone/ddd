@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">ສ້າງໝວດສິນຄ້າ</div>

                    <div class="panel-body">
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('categories.index') }}"> ກັບຄືນ</a>
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('categories.store') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ລະຫັດ</strong>
                                        <input type="text" name="code" class="form-control" placeholder="ລະຫັດໝວດສິນຄ້າ">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ໝວດສິນຄ້າ:</strong>
                                        <input type="text" name="cat_name" class="form-control" placeholder="ໝວດສິນຄ້າ">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 ">
                                    <button type="submit" class="btn btn-primary pull-right">ເພີ່ມໝວດສິນຄ້າ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection