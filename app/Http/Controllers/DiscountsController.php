<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Discount;
use Session;
use Input;
use Datatable;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::all();
        return view('discounts.index')->withDiscounts($discounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discounts.create');
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
            'description' => 'required',
            'percent' => 'required',
            'quantity' => 'required'
        ]);
        $input = $request->all();
        Discount::create($input);
        Session::flash('flash_message', 'Скидка успешно создана!');
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
        $discount = Discount::findOrFail($id);
//dd($discount);
        return view('discounts.show')->withDiscount($discount);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        return view('discounts.edit')->withDiscount($discount);
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

    public function getDatatable()
    {
        return Datatable::collection(Discount::all(array('id','name','description', 'percent', 'quantity')))
            ->showColumns('id', 'name', 'description', 'percent', 'quantity')
            ->addColumn('created',function($model)
            {
                return  date('d-m-Y', strtotime(".$model->created_at."));
            })
            ->addColumn('actions',function($model)
            {
                return  '<a href="/discounts/'.$model->id.'">Просм</a> |
                     <a href="/discounts/'.$model->id.'/edit" >Ред</a>';
            })
            ->searchColumns('name', 'description', 'percent', 'quantity')
            ->orderColumns('name', 'description', 'percent', 'quantity')
            ->make();
    }
}
