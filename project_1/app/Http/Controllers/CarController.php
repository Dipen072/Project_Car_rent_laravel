<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function cars()
    {
        $cars = Car::all(); 
        $categories = categories::where('status', 'Active')->get();
        return view('website.cars', compact('cars', 'categories'));
    }

  public function display_cars()
  {
    $cars = Car::all();
    return response()->json([
        'status' => 1,
        'message' => 'Cars Displayed Successfully!',
        'data' => $cars,
    ]);
  }

    public function index()
   {
    $car_arr = car::all();
    return view('admin.manage_cars', ['car_arr' => $car_arr]);
   }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $categories = Category::all();   // ✅ yahi missing tha
    return view('admin.add_car', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'car_name' => 'required',
            'brand' => 'required',
            'category_id' => 'required|integer',
            'price_per_day' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'description' => 'required',
        ]);

        $table = new Car();
        $table->car_name = $request->car_name;
        $table->brand = $request->brand;
        $table->category_id = $request->category_id;
        $table->price_per_day = $request->price_per_day;
        $table->description = $request->description;

         // image upload

         if($request->hasFile('image')){
            $file = time().'.'.$request->image->extension();
            $request->image->move('upload/cars', $file);
            $table->image = $file;
         }
        

        $table->save();
        return response()->json([
            'status' => 1,
            'message' => 'Car Added Successfully!',
            'data' => $table,
        ]);
        Alert::success('Car Added Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::find($id);
        return response()->json([
            'status' => 1,
            'message' => 'Car Found!',
            'data' => $car,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = car::find($id);
        $categories = Category::all();
        return view('admin.edit_car', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = car::find($id);
        $data->car_name = $request->car_name;
        $data->brand = $request->brand;
        $data->category_id = $request->category_id;
        $data->price_per_day = $request->price_per_day;
        $data->description = $request->description;

         // image upload

         if($request->hasFile('image')){
            $file = time().'.'.$request->image->extension();
            $request->image->move('upload/cars', $file);
            $data->image = $file;
         }
        

        $data->update();
        Alert::success('Car Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $data = car::find($id);
       if ($data->image && file_exists('upload/cars/'.$data->image)) {
           unlink('upload/cars/'.$data->image);
       }
       $data->delete();
       Alert::success('Car Deleted Successfully');
       return back();
    }
}
