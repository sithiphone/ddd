@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ແກ້ໄຂຂໍ້ມູນຜູ້ສະໜອງ
                        <div class="pull-right">
                            <a href="{{ route('suppliers.index') }}" class="btn btn-primary">ກັບຄືນ</a>
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
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <fieldset>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">ຜູ້ສະໜອງສິນຄ້າ: </label>
                                        <div class="col-md-8">
                                            <input name="name" value="{{ $supplier->name }}" placeholder="ຜູ້ສະໜອງ" class="form-control input-md" type="text">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">ເບີໂທລະສັບ1: </label>
                                        <div class="col-md-8">
                                            <input name="mobile1" value="{{ $supplier->mobile1 }}" placeholder="ເບີໂທລະສັບ1" class="form-control input-md" type="text">
                                            @if ($errors->has('mobile1'))
                                                <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('mobile1') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">ເບີໂທລະສັບ2: </label>
                                        <div class="col-md-8">
                                            <input name="mobile2" value="{{ $supplier->mobile2 }}" placeholder="ເບີໂທລະສັບ2" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">ອີເມວ໌: </label>
                                        <div class="col-md-8">
                                            <input name="email" value="{{ $supplier->email }}" placeholder="ອີເມວ໌" class="form-control input-md" type="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">ທີ່ຢູ່: </label>
                                        <div class="col-md-8">
                                            <textarea name="address" class="form-control">{{ $supplier->address }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="col-md-4 control-label" for="textinput"></label>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary pull-right">ແກ້ໄຂຂໍ້ມູນຜູ້ສະໜອງ</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
