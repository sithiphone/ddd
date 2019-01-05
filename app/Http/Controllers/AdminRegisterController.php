<?php

namespace App\Http\Controllers;

use App\Role;
use App\User_role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use DB;
class AdminRegisterController extends Controller
{
    public function index(Request $request){
        $msg = '';
        if($request->msg != ''){
            $msg = $request->msg;
        }
        $sel_type = '*';
        $types = DB::table('roles')->select('id', 'description')->get();
        if($request->user_type != '*'){
            $sel_type = $request->user_type;
        }

        if($request->button == 'SEARCH' and $request->user_name != ''){
            $users = DB::table('users')
                ->leftjoin('user_roles', 'user_roles.user_id', '=', 'users.id')
                ->leftjoin('roles', 'roles.id', '=', 'user_roles.role_id')
                ->select('users.id','users.name', 'users.username',
                    'users.dob', 'users.email', 'users.type', 'users.photo',
                    'roles.name as role_name')
                ->where('users.name', 'like', '%' . $request->user_name . '%')
                ->orderBy('roles.id','DESC')->orderBy('id', 'DESC')
                ->paginate(10);
        }elseif($request->button == 'SEARCH' and $request->user_type != '*'){
            $users = DB::table('users')
                ->leftjoin('user_roles', 'user_roles.user_id', '=', 'users.id')
                ->leftjoin('roles', 'roles.id', '=', 'user_roles.role_id')
                ->select('users.id','users.name', 'users.username',
                    'users.dob', 'users.email', 'users.type', 'users.photo',
                    'roles.name as role_name')
                ->where('roles.id', '=', $request->user_type)
                ->orderBy('roles.id','DESC')->orderBy('id', 'DESC')
                ->paginate(10);
        }else{
            if(isset($request->user_type) and $request->user_type != '*'){
                $users = DB::table('users')
                    ->leftjoin('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->select('users.id','users.name', 'users.username',
                        'users.dob', 'users.email', 'users.type', 'users.photo',
                        'roles.name as role_name')
                    ->where('roles.id', '=', $request->user_type)
                    ->orderBy('roles.id','DESC')->orderBy('id', 'DESC')
                    ->paginate(10);
            }else{
                $users = DB::table('users')
                    ->leftjoin('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->select('users.id','users.name', 'users.username',
                        'users.dob', 'users.email', 'users.type', 'users.photo',
                        'roles.name as role_name')
                    ->orderBy('roles.id','DESC')->orderBy('users.id', 'DESC')
                    ->paginate(10);
            }
        }
        //return $users;
        $user_name = ''; $sel_type = '';
        if($request->user_name != ''){
            $user_name = $request->user_name;
        }
        if($request->user_type != '*'){
            $sel_type = $request->user_type;
        }

        return view('admin.index', compact('users', 'msg', 'types', 'sel_type', 'user_name', 'sel_type', 'request'));
    }

    public function showRegisterForm(Request $request){
        $msg = '';
        $roles = Role::all();
        return view('admin.register', compact('msg', 'roles'));
    }

    public function store(Request $request){
        //return $request->all();

        if($request->password == $request->password_confirmation){
            if($request->hasFile('file')){
                $filename = $request->file->getClientOriginalName();
                if($request->file->storeAs('public/photos/staffs', $filename)){
                    //add staff to db
                    if(DB::table('users')
                        ->insert([
                            'id' => null,
                            'name' => $request->name,'email' => $request->email,
                            'password' => bcrypt($request->password),
                            'username' => $request->username,
                            'dob' => $request->dob,
                            'photo' => $filename,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ])){
                        //insert to user_role table
                        //get last insert_id
                        $user = DB::table('users')->select('id')->orderBy('id', 'DESC')->first();
                        $last_user_id = $user->id;
                        //register role for new user
                        DB::table('user_roles')->insert([
                            'user_id' => $last_user_id,
                            'role_id' => $request->role,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }
            }
            $msg = 'ເພີ່ມສະມາຊິກໃໝ່ສຳເລັດສົມບູນ';
        }else{
            $msg = 'ລະຫັດຜ່ານບໍ່ກົງກັນ';
        }
        return redirect(route('admin.register', ['msg'=> $msg]));
    }

    public function showChangePasswordForm($id){
        $user_id = $id;
        $user = User::find($id);
        $msg = '';
        return view('admin.changepasswd', compact('user', 'user_id', 'msg'));
    }

    public function resetPassword(Request $request){
        if($request->password != '' and ($request->password == $request->password_confirmation)){
            $pass = bcrypt($request->password);
            DB::table('users')->where('id', '=', $request->user_id)->update(['password'=>$pass]);
            $msg = 'ປ່ຽນລະຫັັດຜ່ານສຳເລັດ';
            return redirect(route('admin.register', ['msg'=>$msg]));
        }else{
            $msg = 'ລະຫັດຜ່ານບໍ່ກົງກັນ';
            $user_id = $request->user_id;
            $user = User::find($request->user_id);
            return view('admin.changepasswd', compact('user', 'user_id', 'msg'));
        }
    }

    public function update($id){
        $user = User::find($id);
        return view('admin.update', compact('user'));
    }

    public function edit(Request $request){
        //return $request->all();
        if($request->hasFile('file')){
            $filename = $request->file->getClientOriginalName();
            if($request->file->storeAs('public/photos/staffs', $filename)){
                //add staff to db
                DB::table('users')
                    ->where('id', '=', $request->user_id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'username' => $request->username,
                        'dob' => $request->dob,
                        'type' => $request->type,
                        'photo' => $filename,
                        'updated_at' => Carbon::now(),
                    ]);
            }
            $msg = 'ປັບປຸງຂໍ້ມູນສຳເລັດ';
        }else{
            DB::table('users')
                ->where('id', '=', $request->user_id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'dob' => $request->dob,
                    'type' => $request->type,
                    'updated_at' => Carbon::now(),
                ]);
            $msg = 'ປັບປຸງຂໍ້ມູນສຳເລັດ';
        }
        return redirect(route('admin.register', ['msg'=>$msg]));
    }

    public function delete($id){
        $msg = '';
        if(DB::table('users')->where('id', '=', $id)->delete()){
            $msg = 'ລຶບລ້າງຜູ້ໃຊ້ອອກຖານຂໍ້ມູນສຳເລັດ';
        }
        return route('admin.register', ['msg'=> $msg]);
    }

    public function showChangePrivilegeForm($id){
        $user_id = $id;
        $user = User::find($id);
        $msg = '';
        $role_id = DB::table('user_roles')->select('role_id')->where('user_id', '=', $user_id)->first();
        $role_id = $role_id->role_id;
        return view('admin.privilege',compact('user_id', 'user', 'msg', 'role_id'));
    }
    public function changePrivilege(Request $request){
        //return $request->all();
        if(DB::table('user_roles')->where('user_id', '=', $request->user_id)->update(['role_id'=>$request->privilege])){
            $msg = "ປ່ຽນສິດທິຜູ້ໃຊ້ລະບົບສຳເລັດ";
        }
        return redirect(route('admin.register',['msg'=>$msg]));
    }
}
