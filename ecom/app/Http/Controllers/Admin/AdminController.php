<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use App\Models\Admin\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }
        else{
            $request->session()->flash('error','Access Denied');
            return view('admin.login');
        }
        
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password= $request->input('password');

        $result = Admin::where('username',$username)->first();
        if($result){
            if(Hash::check($password,$result->password)){
                $request->session()->put('ROLE',$result->role);
                $request->session()->put('ADMIN_LOGIN','true');
                $request->session()->put('ADMIN_ID',$result->id);
                return redirect('admin/dashboard');
            }
            else{
                $request->session()->flash('error','Please Enter Correct Password');
                return redirect('admin');
            }
        }
        else{
            $request->session()->flash('error','Please Enter Valid Login Details.');
            return redirect('admin');
        } 
    }

    public function updatePassword(){
        $result = Admin::find(1);
        $result->password = Hash::make('1234');
        $result->save();
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {
        //
    }
}
