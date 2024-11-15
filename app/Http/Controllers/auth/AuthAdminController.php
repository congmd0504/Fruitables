<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\PostUserAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(PostUserAdminRequest $request)
    {
        $data =$request->all();
        if($request->hasFile('image')){
            $data['image'] = Storage::put('user', $request->file('image'));
        }
        User::create($data);
        return back()->with('success','Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->only('active');
        $user->update($data);
        return back()->with('success','Cập nhập thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
