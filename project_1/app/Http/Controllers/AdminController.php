<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CarCategory;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    public function admin_login()
    {
        return view('admin.admin-login');
    }

    public function admin_auth(Request $request)
    {
        $admin = Admin::where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        // Create session
        if ($admin) {
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);

            // Create Cookie
            Cookie::queue('cemail', $admin->email, 2);
            Cookie::queue('cpass', $admin->password, 2);

            Alert::success('Login Successful', 'Welcome Admin 👋');
            return redirect('/dashboard');
        } else {
            Alert::error('Login Failed', 'login failed due to wrong password');
            return back();
        }
    }

public function add_cars()
{
    return view('admin.add_cars');
}

public function add_cars_post(Request $request)
{
    $category = new CarCategory();
    $category->name = $request->cat_name;
    $category->description = $request->cat_desc;
    $category->image = $request->cat_image;
    $category->save();
    return redirect('/add_categories')->with('success', 'Category added successfully');
}

    public function dashboard()
    {
        // 🔍 CHECK SESSION
        if (!Session::has('admin_id')) {
            return redirect('/admin-login');
        }

        return view('admin.dashboard');
    }

    public function admin_logout()
    {
        // Session clear
        Session::pull('admin_id');
        Session::pull('admin_name');

        // Logout alert
        Alert::success('Success', 'Logout Successfully 👋');

        // Redirect to login
        return redirect('/admin-login');
    }
}