<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Dish;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('admin.dishes.create', compact( 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Dish $dish)
    {

        $request->validate([   
            'dish_name' => 'required|string|max:255',
            'dish_photo' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'is_vegetarian' => 'required|boolean',
        ]);

        $formData = $request->all();
        $user = Auth::user();
        $newDish = new Dish();
        $newDish->fill($formData);
        $newDish['dish_slug'] = Str::slug($formData['dish_name'], '-');
        $newDish->restaurant_id = $user->id;
        $newDish->save();

        return redirect()->route('admin.dishes.show', ['dish' => $newDish->dish_slug]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
