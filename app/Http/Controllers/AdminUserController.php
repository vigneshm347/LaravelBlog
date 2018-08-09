<?php

namespace App\Http\Controllers;
use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\User;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $users = User::all();
        //return Storage::disk('public')->get('storage/app/images/Adminhadk-1.PNG');
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = $this->getUserRoles();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

        $input = $request->all();
        $file = $request->file('photo_id');
        if($file){
            $size = $file->getClientSize();
            $fileNameWithExt = $file->getClientOriginalName();
            $fileNameToStore = time() . '_' . $fileNameWithExt;
            $file->storeAs('public/upload', $fileNameToStore);
            $photo = (Photo::create(["path" => $fileNameToStore, "size" => $size]));
            $input['photo_id'] = $photo->id;
        }
        else{
            $input['photo_id'] = 0;
        }
        $input['password'] = bcrypt($request->password);
        User::create($input);
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = $this->getUserRoles();
        return view('admin.users.edit', compact('user', 'roles', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user=User::findOrFail($id);
        if($request->password == ""){
            $input = $request->except('password');
        } else{
           $input = $request->all();
           $input['password'] = bcrypt($request->password);
        };
        $file = $request->file('photo_id');
        if($file){
            $size = $file->getClientSize();
            $fileNameWithExt = $file->getClientOriginalName();
            $fileNameToStore = time() . '_' . $fileNameWithExt;
            $file->storeAs('public/upload', $fileNameToStore);
            $photo = (Photo::create(["path" => $fileNameToStore, "size" => $size]));
            $input['photo_id'] = $photo->id;
        }
        else{
            $input['photo_id'] = 0;
        }

            $user->update($input);
        return redirect('/admin/users');
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //C:\xampp\htdocs\blogApp\storage\app\public\upload\1533764748_Capture.PNG
        $user = User::find($id);
        if($user->photo_id !=0){
            $filename = pathinfo($user->photo->path, PATHINFO_FILENAME);
            $fileExtention = pathinfo($user->photo->path, PATHINFO_EXTENSION);
            unlink(storage_path('app\public\upload'.'\\'.$filename.'.'.$fileExtention));
            Storage::delete($filename.'.'.$fileExtention);
        }

        User::find($id)->delete();

        Session::flash('user_deleted', 'User has been deleted');

        return redirect()->route('users.index');
    }

    public function getUserRoles()
    {
        return Role::pluck('name', 'id')->toArray();
    }




}
