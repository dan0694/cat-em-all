<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Breed;
use App\Models\CatImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Cat::where('user_id', Auth::user()->id)->get();
        return view('dashboard', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breeds = Breed::all();
        return view('cat.create', compact('breeds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $cat = new Cat;
            $cat->name = $request->name;
            $cat->description = $request->description;
            $cat->birthday = $request->birthday;
            $cat->gender = $request->gender;
            $cat->location = CatController::formatLocation($request->location);
            $cat->user_id =  Auth::user()->id;
            $cat->breed_id = $request->breed;
            $cat->save();

             if($request->file){
                CatController::addImage($request->file, $cat);
            }

            Session::flash('success', 'Your cat has been added.');
            return redirect()->route('dashboard');

        } catch (Exception $e) {
            Session::flash('danger', 'Oops, an error has occured, please try again.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Cat::find($id);
        return view('cat.locate', compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Cat::find($id);
        $breeds = Breed::all();
        return view('cat.edit', compact('cat', 'breeds'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $cat = Cat::find($id);
            $cat->name = $request->name;
            $cat->description = $request->description;
            $cat->birthday = $request->birthday;
            $cat->gender = $request->gender;
            if($request->location){$cat->location = CatController::formatLocation($request->location);}
            $cat->breed_id = $request->breed;
            $cat->update();

            if($request->file){
                CatController::addImage($request->file, $cat);
            }

            Session::flash('success', "Your cat's info has been updated.");
            return redirect()->route('dashboard');

        } catch (Exception $e) {
            Session::flash('danger', 'Oops, an error has occured, please try again.');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cat = Cat::findOrFail($id);
         
            if (isset($cat)) {
                $cat->delete();
                Session::flash('success', 'The cat has been removed');
                return redirect()->route('dashboard');
            } else {
                Session::flash('danger', "This cat doesn't exist. Please select another one.");
                return redirect()->back();
            }

        } catch(Exception $e) {
            Session::flash('danger', 'Oops, an error has occured, please try again.');
            return redirect()->back();
        }
    }

    public function map(){
        $cats = Cat::where('user_id', Auth::user()->id)->with('breed', 'image' )->get();
        return view('cat.map', compact('cats'));
    }

    public function formatLocation($location){
        $location = substr($location, 6);
        $location = str_replace("(", "", $location);
        $location = str_replace(")", "", $location);
        return $location;
    }

    public function addImage($img, $cat){
        $path = Storage::disk('s3')->put('cat-images', $img);
        if($cat->image){
            $image =  $cat->image;
            Storage::disk('s3')->delete($image->path);
        } else{
            $image = new CatImage();
        }
        $image->path = $path;
        $image->title = $img->getClientOriginalName();
        $image->size = $img->getSize();
        $image->cat_id = $cat->id;
        $image->save();
    }
}
