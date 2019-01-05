@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ແບບຟອມເພີ່ມລາຍການສິນຄ້າເຂົ້າໃໝ່
                        <div class="pull-right">
                            <a href="{{ route('products.index') }}" class="btn btn-primary">ກັບຄືນ</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('product.upload') }}" enctype="multipart/form-data" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <fieldset>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ໝວດສິນຄ້າ: </label>
                                    <div class="col-md-4">
                                        <select name="categories_id" class="form-control">
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ລະຫັດສິນຄ້າ: </label>
                                    <div class="col-md-4">
                                        <input id="textinput" name="code" value="" placeholder="ລະຫັດສິນຄ້າ" class="form-control input-md" type="text">
                                        @if ($errors->has('code'))
                                            <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ຊື່ສິນຄ້າ: </label>
                                    <div class="col-md-4">
                                        <input id="textinput" name="name" value="" placeholder="ຊື່ສິນຄ້າ" class="form-control input-md" type="text">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ຫົວໜ່ວຍ: </label>
                                    <div class="col-md-4">
                                        <select name="unit_id" class="form-control">
                                            @foreach($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->unit_lao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ລາຄາສິນຄ້າ: </label>
                                    <div class="col-md-4">
                                        <input id="textinput" name="price" value="" placeholder="ລາຄາສິນຄ້າ" class="form-control input-md" type="text">
                                        @if ($errors->has('price'))
                                            <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ຮູບສິນຄ້າ: </label>
                                    <div class="col-md-4">
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <button id="singlebutton" type="submit" name="button" class="btn btn-primary" style="margin-left: 380px;">
                                            ເພີ່ມເຂົ້າລາຍການ
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()