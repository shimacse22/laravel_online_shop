<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function login(){
        return view('frontend.login');
    }

    public function register(){
        return view('frontend.register');
    }
    public function index(Request $request){
        $users=User::latest();

        if(!empty($request->keyword)){
            $users= $users->where('name','like','%'.$request->get('keyword').'%');
        }
        $users= $users->paginate(4);
       
        return view('admin.user.index',compact('users'));

    }

    public function create(){
        return view('admin.user.create');
    }

    public function store(Request $request){

        $validator= Validator::make($request->all(),[
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' =>'required|min:5',
            'phone' =>'required',
             //'address' =>'required',
            'status'=>'required'
        ]);


        if ($validator->passes()){
           
            $users=new User();
            $users->name=$request->name;
            $users->email=$request->email;
            $users->password=Hash::make($request->password);
            $users->phone=$request->phone;
            $users->status=$request->status;
            $users->save();

            session()->flash('success','user added successfully');
            return response()->json([
                'status'=>true,
                'message' =>'user added successfully'
            ]);
    

        }
        else{

            return response()->json([
                'status'=>false,
                'errors' =>$validator->errors()
            ]);
          
        }

    }

    public function edit($id){
        $user= User::findOrFail($id);

        return view('admin.user.edit',compact('user'));
    }

    public function update($id,Request $request){

        $user= User::findOrFail($id);
        $validator= Validator::make($request->all(),[
            'name' =>'required',
            'email' =>'required|email',
            'password' =>'required|min:5',
            'phone' =>'required',
            //'status'=>'required'
        ]);


        if ($validator->passes()){
           
          
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->phone=$request->phone;
            $user->status=$request->status;
            $user->update();

            session()->flash('success','user updated successfully');
            return response()->json([
                'status'=>true,
                'message' =>'user updated successfully'
            ]);

        }
        else{

            return response()->json([
                'status'=>false,
                'errors' =>$validator->errors()
            ]);
          
        }
    }

    public function destroy($id){

        $user= User::findOrFail($id);

        $user->delete();

        session()->flash('success','user deleted successfully');

            return response()->json([
                'status'=>true,
                'message' =>'user deleted successfully'
            ]);
       

    }
  
}
