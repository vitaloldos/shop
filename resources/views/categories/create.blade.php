<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 26.11.15
 * Time: 13:34
 */
 -->
@extends('layouts.master')

@section('content')

    <h1>Добавьте новую категорию:</h1>
    <p class="lead">Заполните все необходимые поля для категории.</p>
    <hr>

    @include('partials.alerts.errors')

    {!! Form::open([
    'route' => 'categories.store'
    ]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Название:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('parent_id', 'Добавьте главную категорию', ['class' => 'control-label']) !!}
        {!! Form::select('parent_id', $parent_category, null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Cоздать новую категорию', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

@stop