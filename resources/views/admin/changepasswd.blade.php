@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px;">ຕັ້ງລະຫັດຜູ້ໃຊ້ຄືນໃໝ່</div>
                @if($msg != '')
                    <div class="alert alert-danger">
                        <strong>{{ $msg }}</strong>
                    </div>
                @endif
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.change.password') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">ຊື່ ແລະ ນາມສະກຸນ</label>

                            <div class="col-md-6">
                                <input id="user_name" value="{{ $user->name }}" type="text" class="form-control" name="user_name" disabled>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">ລະຫັດຜ່ານ</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">ຢືນຢັນລະຫັດຜ່ານອີກຄັ້ງ</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    ປ່ຽນລະຫັດ
                                </button>
                                <a href="{{ route('admin.register') }}" class="btn btn-primary">ຍົກເລີກ</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
