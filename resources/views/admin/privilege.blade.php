@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px;">ກຳນົດສິດຜູ້ໃຊ້ລະບົບຖານຂໍ້ມູນ</div>
                @if($msg != '')
                    <div class="alert alert-danger">
                        <strong>{{ $msg }}</strong>
                    </div>
                @endif
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.change.privilege') }}">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <div class="col-md-3">
                            <div class="form-group">
                                <img src="{{ asset("/storage/photos/staffs/$user->photo") }}"  style="height: 200px;"/>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="user_name" class="col-md-4 control-label">ຊື່ ແລະ ນາມສະກຸນ</label>
                                <div class="col-md-6">
                                    <input id="user_name" value="{{ $user->name }}" type="text" class="form-control" name="user_name" disabled>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">ກຳນົດລະດັບສິດທິເປັນ</label>
                                <div class="col-md-6">
                                    <div class="col-md-4">
                                        <label><input @if($role_id == 1) checked @endif type="radio" class="form-control" name="privilege" value="1"> ສະມາຊິກ</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><input @if($role_id == 2) checked @endif  type="radio" class="form-control" name="privilege" value="2"> ຜູ້ຄຸ້ມຄອງ</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><input @if($role_id == 3) checked @endif  type="radio" class="form-control" name="privilege" value="3"> ຜູ້ຄຸ້ມຄອງສູງສຸດ</label>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        ປ່ຽນສິດທິ
                                    </button>
                                    <a href="{{ route('admin.register') }}" class="btn btn-primary">ຍົກເລີກ</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
