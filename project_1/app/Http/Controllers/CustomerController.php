<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;


class CustomerController extends Controller
{

public function display_customers()
{
    $customers = customer::all();
    return response()->json([
        'status' => 1,
        'message' => 'Customers Displayed Successfully!',
        'data' => $customers,
    ]);
}

public function index()
{
    $customers = Customer::all();

    return response()->json([
        'status' => 1,
        'data' => $customers
    ]);
}

public function create()
{
    return view('website.singup');
}

public function login()
{
    return view('website.login');
}

    // Signup Insert
    public function store(Request $request)
    {
        $table = new Customer();
        $table->name = $request->name;
        $table->email = $request->email;
        $table->mobile = $request->mobile;
        $table->address = $request->address;
        $table->gender = $request->gender;
        $table->hobbies = implode(",",$request->hobbies);
        $table->city = $request->city;
        $table->state = $request->state;
        $table->pincode = $request->pincode;
        $table->license_number = $request->license_number;
        $table->password = Hash::make($request->password);
       

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_img.' . $file->getClientOriginalExtension();
            $file->move('upload/customer', $filename);
            $table->profile_image = $filename;
        }
       
        $table->status = "Unblocked";
        $table->save();
        Alert::success('success','Registration Successful!');
        return response()->json([
            'status' => 1,
            'message' => 'Inserted Successful!',
            'data' => $table,
        ]);
    }

    public function show($id)
    {
        $customers = customer::find($id);
        return response()->json($customers);
        return[
            'status' => 1,
            'message' => 'Customer Found!',
            'data' => $customers,
        ];
    }

    public function manage_customers()
    {
        $customers = customer::paginate(10);
        return view('admin.manage_customers', ['customers' => $customers]);
    }

    // Login Check

    public function check_login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $data = customer::where('email', $request->email)->first();
        if ($data) {                    // your value  === enc_value
            if (!(Hash::check($request->password, $data->password))) {
                Alert::error('Failed', 'Login Failed Due to Wrong Password');
                return back();
            } else {

                if ($data->status == "Unblocked") {
                   
                    //create session 
                    session()->put('user_id', $data->id);
                    session()->put('user_name', $data->name);

                    //session()->get('session_name') or session('session_name')  =>  get session

                    //session()->pull('session_name') or   =>  delete session

                    // if(session('session_name'))  or if(session()->has('session_name')) => check session

                    Alert::success('Success', 'Login Success');
                    return redirect('/');
                }
                else
                {
                    Alert::error('Failed', 'Account Blocked !');
                    return back();
                }
            }
        } else {
            Alert::error('Failed', 'Login Failed Due to Wrong Email');
            return back();
        }
    }
    // User Profile
    public function user_profile(customer $customer)
    {
        $data = customer::where('id', session('user_id'))->first();
        return view('website.user_profile', ["data" => $data]);
    }


    public function user_logout()
    {
        Session::pull('user_id');
        Session::pull('user_name');
        Alert::success('success','Logout Successful!');
        return redirect('/index');
    }

    // Edit Profile
    public function edit($id)
    {
        $data = customer::find($id);
        return view('website.edit-profile', ['data' => $data]);
    }

    // Update Profile

public function update(Request $request,$id)
{
   $data = customer::find($id);
   $data->name = $request->name;
   $data->email = $request->email;
   $data->mobile = $request->mobile;
   $data->address = $request->address;
   $data->city = $request->city;
   $data->gender = $request->gender;
   $data->hobbies = $request->hobbies;
   $data->state = $request->state;
   $data->pincode = $request->pincode;
   $data->license_number = $request->license_number;


   if ($request->hasFile('profile_image')) {
    $file = $request->file('profile_image');
    $filename = time() . '_img.' . $file->getClientOriginalExtension();
    $file->move('upload/customer', $filename);
    $data->profile_image = $filename;
}

   $data->update();
   Alert::success('success','Profile Updated Successfully!');
   return redirect('/user-profile');
}

    public function destroy(Customer $customer , $id)
    {
        $customer = customer::find($id)->delete();
        unlink('upload/customer/'.$data->profile_image);
        Alert::success('Customer Deleted Success');
        return back();
    }

    public function status_customer(customer $customer,$id)
    {
        $data = customer::find($id);
        if($data->status == "Blocked")
        {
            $data->status = "Unblocked";
            $data->save();
            Alert::success('Customer Unblocked Success');
            return back();
        }
        else
        {
            $data->status = "Blocked";
            $data->save();
            session()->pull('user_id');
            session()->pull('user_name');
            Alert::success('Customer Blocked Success');
            return back();
        }
    }
    
    // Logout
    public function logout()
    {
      Session::pull('user_id');
      Session::pull('user_name');
      Alert::success('success','Logout Successful!');
      return redirect('/login');
    }
}
