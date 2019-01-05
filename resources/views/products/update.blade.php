@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ແບບຟອມແກ້ໄຂຂໍ້ມູນສິນຄ້າ
                        <div class="pull-right">
                            <a href="{{ route('products.index') }}" class="btn btn-primary">ກັບຄືນ</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('products.update', ['id' => $product->id ]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ລະຫັດສິນຄ້າ: </label>
                                    <div class="col-md-8">
                                        <input id="textinput" name="code" value="{{ $product->code }}" placeholder="ລະຫັດສິນຄ້າ" class="form-control input-md" type="text">
                                        @if ($errors->has('code'))
                                            <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8" style="margin-top: 10px;">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ໝວດສິນຄ້າ: </label>
                                    <div class="col-md-8">
                                        <select name="categories_id" class="form-control">
                                            @foreach($categories as $cat)
                                                @if($cat->id == $product->category_id)
                                                    <option selected="selected" value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @else
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8" style="margin-top: 10px;">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ຊື່ສິນຄ້າ: </label>
                                    <div class="col-md-8">
                                        <input id="textinput" name="name" value="{{ $product->name }}" placeholder="ຊື່ສິນຄ້າ" class="form-control input-md" type="text">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8" style="margin-top: 10px;">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ຫົວໜ່ວຍ: </label>
                                    <div class="col-md-4">
                                        <select name="unit_id" class="form-control">
                                            @foreach($units as $unit)
                                                @if($product->unit_id == $unit->id)
                                                    <option selected="selected" value="{{ $unit->id }}">{{ $unit->unit_lao }}</option>
                                                @else
                                                    <option value="{{ $unit->id }}">{{ $unit->unit_lao }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8" style="margin-top: 10px;">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ລາຄາສິນຄ້າ: </label>
                                    <div class="col-md-8">
                                        <input id="textinput" name="price" value="{{ $product->price }}" placeholder="ລາຄາສິນຄ້າ" class="form-control input-md" type="text">
                                        @if ($errors->has('price'))
                                            <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8" style="margin-top: 10px;">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ຮູບສິນຄ້າ: </label>
                                    <div class="col-md-8">
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8" style="margin-top: 10px;">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput"></label>
                                    <div class="col-md-8">
                                        <button id="singlebutton" type="submit" name="button" class="btn btn-primary">
                                            ແກ້ໄຂຂໍ້ມູນ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()