<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Image;
use App\Discount;
use App\ProdDiscount;
use Session;
use Datatable;
use Input;
use Response;
use Validator;


class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index')->withProducts($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(array('id','name','parent_id'));
        $parent_category['0'] = 'Выберите родительскую категорию';
        foreach ($categories as $key => $category) {
            if ($category->parent_id == '')
                $parent_category[$category->id] = $category->name;
        }
        $discounts = Discount::all(array('id', 'name', 'description'));
//        $discounts['0'] = 'Выберите скидки';
        foreach ($discounts as $key => $discount) {
                $disc[$discount->id] = $discount->name;
        }
//dd($discounts);
        return view('products.create', compact('parent_category', 'disc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'shot_description' => 'required',
            'full_description' =>'required'
        ]);

        $files =Input::file('images');
        $input = $request->all();
        $discounts = $input['discounts'];
        $rules = array(
            'file' => 'image|max:3000',
        );

        $validator = Validator::make($files, $rules);
        if ($validator->fails()) {
            Session::flash('flash_message', 'Ошибка записи файлов!');
            return redirect()->back();
        }
        else {
            $files = array_get($input,'images');
            $destinationPath = 'uploads/images/';
            foreach($files as $key => $file)
            {
                $filename[$key] = str_random(15).'_'.substr($file->getClientOriginalName(), 0, strpos($file->getClientOriginalName(), ".")).'.'.$file->getClientOriginalExtension();
                $upload_success = $file->move($destinationPath, $filename[$key]);
            }
            Session::flash('flash_message', 'Файлы успешно сохранены!');
        }
        $prod_id = Product::create($input);
        foreach ($filename as $fname) {
            $image = new Image();
            $image->prod_id = $prod_id->id;
            $image->path = $destinationPath . $fname;
            $image->save();
        }
        foreach ($discounts as $disc) {
            $discount = new ProdDiscount();
            $discount->prod_id = $prod_id->id;
            $discount->discount_id = $disc;
            $discount->save();
        }
        Session::flash('flash_message', 'Продукт успешно создан!');
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
        $product = Product::findOrFail($id);
        $category = Category::findOrFail($product->cat_id);
        $parent_category = Category::findOrFail($category->parent_id);
        $images = Image::where('prod_id', '=', $id)->get();
        $discounts = ProdDiscount::where('prod_id', '=', $id)->get();
        foreach ($discounts as $key => $discount) {
            $disc = Discount::where('id', '=', $discount->discount_id)->get();
            $discounts[$key]->disc_name = $disc[0]->name;
            $discounts[$key]->disc_description = $disc[0]->description;
        }
//dd($discounts);
        return view('products.show',compact('parent_category','category', 'images', 'discounts'))->withProduct($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all(array('id','name','parent_id'));
        $parent_category['0'] = 'Выберите родительскую категорию';
        foreach ($categories as $key => $category) {
            if ($category->parent_id == '')
                $parent_category[$category->id] = $category->name;

        }
        $product = Product::findOrFail($id);
        $images = Image::where('prod_id', '=', $id)->get();
        $category = Category::findOrFail($product->cat_id);
        $par_cat = Category::where('id', '=', $category->parent_id)->lists('name','id');
        $cat = array($category->id => $category->name);

        $discounts = ProdDiscount::where('prod_id', '=', $id)->get();
        foreach ($discounts as $key => $discount) {
            $disc = Discount::where('id', '=', $discount->discount_id)->get();
            $discounts[$key]->disc_name = $disc[0]->name;
            $discounts[$key]->disc_description = $disc[0]->description;
            $disc_old[$discounts[$key]->id] = $discounts[$key]->disc_name;
        }

        $discounts_all = Discount::all(array('id', 'name', 'description'));
//        $discounts['0'] = 'Выберите скидки';
        foreach ($discounts_all as $key => $discount_all) {
            $disc_all[$discount_all->id] = $discount_all->name;
        }
//dd($disc_old);
        return view('products.edit',compact('par_cat','cat', 'parent_category', 'images', 'discounts', 'disc_old', 'disc_all'))->withProduct($product);
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
        $product = Product::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'shot_description' => 'required',
            'full_description' =>'required'
        ]);

        $input = $request->all();
//dd($input);
        $product->fill($input)->save();
        $discounts = $input['discounts'];

        $discounts_old = ProdDiscount::where('prod_id', '=', $id)->get();
        foreach ($discounts_old as $discount_old) {
            $discount_old->delete();
        }
        foreach ($discounts as $disc) {
            $discount = new ProdDiscount();
            $discount->prod_id = $id;
            $discount->discount_id = $disc;
            $discount->save();
        }

        Session::flash('flash_message', 'Продукт успешно изменен!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $images = Image::where('prod_id', '=', $id)->get();
        foreach ($images as $image) {
            $image->delete();
            unlink($image->path);
        }
        $product->delete();
        Session::flash('flash_message', 'Продукт успешно удален!');
        return redirect()->route('products.index');
    }

    public function getDatatable()
    {
       return Datatable::collection(Product::all(array('id','name','shot_description')))
           ->showColumns('id', 'name', 'shot_description')
           ->addColumn('created',function($model)
           {
               return  date('d-m-Y', strtotime(".$model->created_at."));
           })
            ->addColumn('actions',function($model)
                {
                    return  '<a href="/products/'.$model->id.'">Просм</a> |
                     <a href="/products/'.$model->id.'/edit" >Ред</a>';
                })
           ->searchColumns('name', 'shot_description', 'created')
           ->orderColumns('name','shot_description', 'created')
           ->make();
    }

    public function getDropdown(){
        $input = Input::get('option');
        $maker = Category::where('parent_id', '=', $input)->get(array('id','name'));
        return $maker;
    }

}



