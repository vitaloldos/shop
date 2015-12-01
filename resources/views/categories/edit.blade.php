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

    <h1>Редактируемая категория - {{$category->name}}</h1>
    <p class="lead">Для редактировния измените значения полей. <a href="{{ route('categories.index') }}">Вернуться к списку категорий.</a></p>
    <hr>

    @include('partials.alerts.errors')

    {!! Form::model($category, [
    'method' => 'PATCH',
    'route' => ['categories.update', $category->id]
    ]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Текущая категория:', ['class' => 'control-label']) !!}
        {!! Form::text('name',  null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('parent_id', 'Измените главную категорию', ['class' => 'control-label']) !!}
        {!! Form::select('parent_id', $parent_category, null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Обновить категорию', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

@stop