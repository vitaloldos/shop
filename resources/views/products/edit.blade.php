<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 24.11.15
 * Time: 15:22
 */
 -->
@extends('layouts.master')

@section('content')

    <h1>Редактируемый продукт - {{$product->name}}</h1>
    <p class="lead">Для редактировния измените значения полей. <a href="{{ route('products.index') }}">Вернуться к списку продуктов.</a></p>
    <hr>

    @include('partials.alerts.errors')

    {!! Form::model($product, [
    'method' => 'PATCH',
    'route' => ['products.update', $product->id]
    ]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Название:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div id="new-category">
        <div class="form-group">
            {!! Form::label('parent_id', 'Выберите главную категорию', ['class' => 'control-label']) !!}
            {!! Form::select('parent_id', $parent_category, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group" id="sub-cat">
            {!! Form::label('cat_id', 'Выберите дочернюю категорию', ['class' => 'control-label']) !!}
            <select id="cat_id" name="cat_id" class="form-control">
            </select>
        </div>
    </div>

    <div id="old-category">
        <div class="form-group">
            {!! Form::label('parent_id_old', 'Главная категория', ['class' => 'control-label']) !!}
            {!! Form::select('parent_id_old', $par_cat, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group" >
            {!! Form::label('cat_id_old', 'Дочерняя категория', ['class' => 'control-label']) !!}
            {!! Form::select('cat_id_old', $cat, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <p>
        <a href="#" id="cat-open-edit"  class="btn btn-info">Редактировать категорию</a>
    </p>

    <div class="form-group" id="old_discounts">
        {!! Form::label('discount_id_old', 'Существующие скидки', ['class' => 'control-label']) !!}
        {!! Form::select('discount_id_old', $disc_old, null, ['class' => 'form-control', 'multiple'=>'multiple','name'=>'discounts[]']) !!}
    </div>

    <p>
        <a href="#" id="discount-open-edit"  class="btn btn-info">Редактировать скидки</a>
    </p>

    <div class="form-group" id="new_discount">
        {!! Form::label('discount_id', 'Выберите скидки заново', ['class' => 'control-label']) !!}
        {!! Form::select('discount_id', $disc_all, null, ['class' => 'form-control', 'multiple'=>'multiple','name'=>'discounts[]']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('shot_description', 'Краткое описание:', ['class' => 'control-label']) !!}
        {!! Form::text('shot_description', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('full_description', 'Описание:', ['class' => 'control-label']) !!}
        {!! Form::textarea('full_description', null, ['class' => 'form-control']) !!}
    </div>
    @foreach ($images as $image)
        <div class="col-md-4">
            <a href="{{ route('images.edit', $image->id) }}" class="thumbnail">
                <p align="center">Нажмите, чтобы редактировать картинку.</p>
                {!! Html::image($image->path, 'Картинка', array('class' => 'thumbnail', 'style' => 'height:228px;')) !!}
            </a>
        </div>
    @endforeach

    <table style="width:100%">
        <tr>
            <td style="width:200px">
                {!! Form::submit('Обновить продукт', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </td>
            <td style="width:350px">
                {!! Form::open([
                'method' => 'post',
                'files' => true,
                'route' => ['images.store']
                ]) !!}
                {!! Form::file('images[]', array('multiple'=>true)) !!}
            </td>
            <td>
                {!! Form::hidden('prod_id', $product->id) !!}
                {!! Form::submit('Дщбавить картинки?', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>

        </tr>
    </table>

@stop