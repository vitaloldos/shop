<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 24.11.15
 * Time: 14:20
 */
 -->
@extends('layouts.master')

@section('content')

    <h1>Добавьте новый продукт:</h1>
    <p class="lead">Заполните все необходимые поля для продукта.</p>
    <hr>

    @include('partials.alerts.errors')

    {!! Form::open([
    'route' => 'products.store',
    'method' => 'post',
    'files' => true
    ]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Название:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('parent_id', 'Выберите главную категорию', ['class' => 'control-label']) !!}
        {!! Form::select('parent_id', $parent_category, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group" id="sub-cat">
        {!! Form::label('cat_id', 'Выберите дочернюю категорию', ['class' => 'control-label']) !!}
        <select id="cat_id" name="cat_id" class="form-control">
        </select>
    </div>

    <div class="form-group">
        {!! Form::label('discount_id', 'Выберите скидку', ['class' => 'control-label']) !!}
        {!! Form::select('discount_id', $disc, null, ['class' => 'form-control', 'multiple'=>'multiple','name'=>'discounts[]']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('shot_description', 'Краткое описние:', ['class' => 'control-label']) !!}
        {!! Form::text('shot_description', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('full_description', 'Описание:', ['class' => 'control-label']) !!}
        {!! Form::textarea('full_description', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('images', 'Выберите картинки', ['class' => 'control-label']) !!}
        {!! Form::file('images[]', array('multiple'=>true)) !!}
    </div>

    {!! Form::submit('Cоздать новый продукт', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

@stop