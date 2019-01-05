@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        ສະມາຊິກຂອງລະບົບຖານຂໍ້ມູນ
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('admin.show.register.form') }}">ເພີ່ມສະມາຊິກ</a>
                        </div>
                    </div>
                    @if($msg != '')
                        <div class="alert alert-success">
                            <strong>{{ $msg }}</strong>
                        </div>
                    @endif
                    <div class="panel-body">
                        <form method="GET" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <fieldset>
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <input type="text" name="user_name" value="{{ $user_name }}" class="form-control" placeholder="ຊື່ສະມາຊິກ" >
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="user_type" onchange="this.form.submit()">
                                        <option value="*">--- ທຸກລະດັບ ---</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}"
                                            @if($sel_type == $type->id)
                                                {{ 'selected="selected"' }}
                                            @endif
                                            >{{ $type->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="button" value="SEARCH" class="btn btn-success">ຄົ້ນຫາ</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ລຳດັບ</th>
                            <th>ຮູບພາບ</th>
                            <th>ຊື່</th>
                            <th>ບັນຊີຊື່ເຂົ້າລະບົບ</th>
                            <th>ວັນເດືອນປີເກີດ</th>
                            <th>ອີເມວ</th>
                            <th style="width: 80px;">ສະມາຊິກ</th>
                            <th style="width: 80px;">ຜູ້ຄຸ້ມ ຄອງ</th>
                            <th style="width: 80px;">ຜູ້ຄຸ້ມຄອງ ສູງສຸດ</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
                        @forelse($users as $user)
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><img src="{{ asset("/storage/photos/staffs/$user->photo") }}"  style="height: 100px;"/></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ Carbon\Carbon::parse($user->dob)->format('d-m-Y') }}</td>
                                <td>{{ $user->email }}</td>
                                <td><input class="form-control" type="checkbox" {{ ($user->role_name == 'Member')? 'checked': '' }} name="role_member"></td>
                                <td><input class="form-control" type="checkbox" {{ ($user->role_name == 'Admin')? 'checked': '' }} name="role_admin"></td>
                                <td><input class="form-control" type="checkbox" {{ ($user->role_name == 'Super_admin')? 'checked': '' }} name="role_super_admin"></td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('admin.change.privilege.form', ['id'=> $user->id]) }}">ສິດທິ</a>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('admin.change.password.form', ['id'=> $user->id]) }}">ລະຫັດຜ່ານ</a>
                                </td>
                                <td><a class="btn btn-primary" href="{{ route('admin.update.profile', ['id'=> $user->id]) }}">ແກ້ໄຂ</a></td>
                                <!--<td><a class="btn btn-danger" href="{{ route('admin.delete.user', ['id'=> $user->id]) }}">ລຶບ</a></td>-->
                            </tr>
                        @empty
                            <tr><td colspan="7" style="color: red;">ບໍ່ມີລາຍການສິນຄ້າໃນຖານຂໍ້ມູນ</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection()

