<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Image;
use App\Product;
use Input;
use Session;
use Validator;

class ImagesController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $files =Input::file('images');
        $input = $request->all();

        $rules = array(
            'file' => 'image|max:3000',
        );

        $validator = Validator::make($files, $rules);
        if ($validator->fails()) {
            Session::flash('flash_message', 'Ошибка записи файлов!');
            return redirect()->back();
        }
        else {
            $destinationPath = 'uploads/images/';
            foreach($files as $key => $file)
            {
                $filename[$key] = str_random(15).'_'.substr($file->getClientOriginalName(), 0, strpos($file->getClientOriginalName(), ".")).'.'.$file->getClientOriginalExtension();
                $upload_success = $file->move($destinationPath, $filename[$key]);
            }
        }
        foreach ($filename as $fname) {
            $image = new Image();
            $image->prod_id = $input['prod_id'];
            $image->path = $destinationPath . $fname;
            $image->save();
        }
        Session::flash('flash_message', 'Картинки успешно добавлены!');
        return redirect()->back();
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
        $image = Image::findOrFail($id);
        $product = Product::findOrFail($image->prod_id);
        return view('images.edit', compact('product'))->withImage($image);
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
    public function destroy( $id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        unlink($image->path);
        Session::flash('flash_message', 'Картинка успешно удалена!');

        return redirect()->route('products.edit', $image->prod_id);

    }

    public function postChange(Request $request)
    {
        $input = $request->all();
        $image = Image::findOrFail($input['id']);
        $file =Input::file('images');
        $rules = array(
            'file' => 'image|max:3000',
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            Session::flash('flash_message', 'Ошибка записи файлов!');
            return redirect()->back();
        }
        else {
            $destinationPath = 'uploads/images/';
            $filename = str_random(15) . '_' . substr($file->getClientOriginalName(), 0, strpos($file->getClientOriginalName(), ".")) . '.' . $file->getClientOriginalExtension();
            $upload_success = $file->move($destinationPath, $filename);
            $image->path = $destinationPath . $filename;
            $image->save();
            unlink($input['path']);
            Session::flash('flash_message', 'Картинка успешно изменена!');
        }
        return redirect()->back();
    }
}
