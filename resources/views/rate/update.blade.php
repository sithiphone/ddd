@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ແກ້ໄຂອັດຕາແລກປ່ຽນ
                        <div class="pull-right">
                            <a href="{{ route('rate.index') }}" class="btn btn-primary">ກັບຄືນ</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('rate.update', $rate->id ) }}" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <fieldset>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">ບາດ: </label>
                                        <div class="col-md-8">
                                            <input id="textinput" name="bath" value="{{ $rate->bath }}"  class="form-control input-md" type="number">
                                            @if ($errors->has('bath'))
                                                <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('bath') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">ໂດລາ: </label>
                                        <div class="col-md-8">
                                            <input id="textinput" name="dolar" value="{{ $rate->dolar }}"  class="form-control input-md" type="number">
                                            @if ($errors->has('dolar'))
                                                <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('dolar') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">ເອີໂຣ: </label>
                                        <div class="col-md-8">
                                            <input id="textinput" name="erro" value="{{ $rate->erro }}"  class="form-control input-md" type="number">
                                            @if ($errors->has('erro'))
                                                <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('erro') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput"></label>
                                        <div class="col-md-8">
                                            <button type="submit" class="btn btn-primary">ປັບປຸງຂໍ້ມູນ</button>
                                        </div>
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
