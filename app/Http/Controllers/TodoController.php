<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Todo;
use App\Models\usertodo;
use App\Models\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Cookie;


class TodoController extends Controller
{
    function signUp(){
        return view('signUp');
    }
    function register(){
        return view('register');
    }
    function index(Request $request0){
        
        $value = request()->cookie('name');
        $t_data = DB::table('todo_list')
        ->where('name', $value)
        ->get();
        
        return view('index', compact('t_data'));
    }
   
    function submit(Request $request){
        //$name = session('name');
        $request->validate([
            'task'=>'required'
        ]);

        $value = request()->cookie('name');

        // Use the 'checked' attribute from the form data
        $checked = $request->has('checked') ? 1 : 0;

        $query = DB::table('todo_list')->insert([
            'task'=>$request->input('task'),
            'time_created'=>now(),
            'name' => $value,
            //'checked' => $checked  // Save the 'checked' value in the database
            
        ]);
        
        if ($query) {
            return back()->with('success', 'The task has been successfully inserted');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }
    
    function delete($id){
        $todo= todo::find($id);

        if ($todo) {
            $todo->delete();
            return back()->with('succesdelete','The task deleted succefully');
        }
        else {
            return back()->with('faildelete', 'someting went wrong');
        }
    }
    /////////////////////////////////////////////////////////
    function addUser(Request $request2){
        $request2->validate([
            'name'=>'required',
            'email' => 'required|email|unique:user_table,email', // Add any other validation rules you need
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        $query2 = DB::table('user_table')->insert([
            'name'=>$request2->input('name'),
            'email'=>$request2->input('email'),
            'password' => $request2->input('password'), // Use bcrypt to hash the password
        ]);
        if ($query2) {
            
            return view('signUp')->with('success', 'User has been successfully registered');
            
        } else {
            return back()->with('fail', 'Something went wrong');
        }
        //return view('signUp');
    }
    function login(Request $request3){
       $request3->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        $existingUser = DB::table('user_table')
            ->where('name', $request3->input('username'))
            ->where('email', $request3->input('email'))
            ->where('password', $request3->input('password'))
            ->first();
    
        if ($existingUser) {
            $cookie = cookie('name', $existingUser->name, 120);
            return redirect()->route('index')->cookie($cookie);
        } else {
            return back()->with('fail', 'User not found or incorrect credentials');
        }
        
    }
   
}
