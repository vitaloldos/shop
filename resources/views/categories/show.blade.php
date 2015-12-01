<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 26.11.15
 * Time: 13:35
 */
 -->
@extends('layouts.master')

@section('content')

    <h1>Категория: {{ $category->name }},</h1>
    <p class="lead">Главная категория: {{$parent_category->name}}.</p>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('categories.index') }}" class="btn btn-info">Вернуться ксписку категорий</a>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Редактировать категорию</a>
        </div>
        <div class="col-md-6 text-right">
            {!! Form::open([
            'method' => 'DELETE',
            'route' => ['categories.destroy', $category->id]
            ]) !!}
            {!! Form::submit('Удалить категорию?', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop