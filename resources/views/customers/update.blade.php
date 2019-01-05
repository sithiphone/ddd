@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ແບບຟອມແກ້ໄຂຂໍ້ມູນລູກຄ້າ
                        <div class="pull-right">
                            <a href="{{ route('customers.index') }}" class="btn btn-primary">ກັບຄືນ</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('customers.update', $customer->id ) }}" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <fieldset>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ລະຫັດ:</label>
                                    <div class="col-md-4">
                                        <input id="textinput" name="code" value="{{ $customer->code }}"
                                               placeholder="ລະຫັດລູກຄ້າ" class="form-control input-md" type="text">
                                        @if ($errors->has('code'))
                                            <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ຊື່ລູກຄ້າ: </label>
                                    <div class="col-md-4">
                                        <input id="textinput" name="name" value="{{ $customer->name }}" placeholder="ຊື່ ແລະ ນາມສະກຸນລູກຄ້າ"
                                               class="form-control input-md" type="text">
                                        <span class="help-block">ຕ.ຢ: ສົມດີ ນາມສົມມຸດ</span>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ເບີໂທລະສັບທີ1: </label>
                                    <div class="col-md-4">
                                        <input id="textinput" name="mobile1" value="{{ $customer->mobile1 }}" placeholder="ເບີໂທຕິດຕໍ່ທີ 1"
                                               class="form-control input-md" type="text">
                                        <span class="help-block">ຕ.ຢ: 22334455</span>
                                        @if ($errors->has('mobile1'))
                                            <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('mobile1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ເບີໂທລະສັບທີ2: </label>
                                    <div class="col-md-4">
                                        <input id="textinput" name="mobile2" value="{{ $customer->mobile2 }}" placeholder="ເບີໂທຕິດຕໍ່ທີ 2"
                                               class="form-control input-md" type="text">
                                        <span class="help-block">ຕ.ຢ: 021-234455</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">ອີເມວ໌: </label>
                                    <div class="col-md-4">
                                        <input id="textinput" name="email" value="{{ $customer->email }}" placeholder="ອີເມວ໌ຕິດຕໍ່"
                                               class="form-control input-md" type="email">
                                        <span class="help-block">ຕ.ຢ: somdee@gmail.com</span>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong style="color: crimson;">{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <button id="singlebutton" type="submit" name="button" class="btn btn-primary" style="margin-left: 380px;">
                                            ແກ້ໄຂຂໍ້ມູນລູກຄ້າ
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
