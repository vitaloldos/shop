<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Session;
use Datatable;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index')->withCategories($categories);
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
        return view('categories.create',compact('parent_category'));
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
        ]);
        $input = $request->all();
        Category::create($input);
        Session::flash('flash_message', 'Категория успешно создана!');
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
        $category = Category::findOrFail($id);
        $parent_category = Category::findOrFail($category->parent_id);
        return view('categories.show', compact('parent_category'))->withCategory($category);


//        $category = Category::findOrFail($id);
//        return view('categories.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all(array('id','name','parent_id'));
        $parent_category['0'] = 'Выберите родительскую категорию';
        foreach ($categories as $key => $cat) {
            if ($cat->parent_id == '')
                $parent_category[$cat->id] = $cat->name;
        }
        return view('categories.edit', compact('parent_category'))->withCategory($category);
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
        $category = Category::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = $request->all();
        $category->fill($input)->save();
        Session::flash('flash_message', 'Категория успешно изменена!');
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
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash('flash_message', 'Категория успешно удалена!');
        return redirect()->route('categories.index');
    }

    public function getDatatable()
    {
        return Datatable::collection(Category::all(array('id','name','parent_id')))
            ->showColumns('id', 'name')
            ->addColumn('parent_category',function($model)
            {
                if ($model->parent_id !='')
                    $parent_category = Category::findOrFail($model->parent_id);
                else {
                    $parent_category = Category::findOrFail($model->id);
                    $parent_category->name = '';
                }
                return  $parent_category->name;
            })
            ->addColumn('created',function($model)
            {
                return  date('d-m-Y', strtotime(".$model->created_at."));
            })
            ->addColumn('actions',function($model)
            {
                return  '<a href="/categories/'.$model->id.'">Просм</a> |
                     <a href="/categories/'.$model->id.'/edit" >Ред</a>';
            })
            ->searchColumns('name', 'parent_id', 'created')
            ->orderColumns('name','parent_id', 'created')
            ->make();
    }
}
