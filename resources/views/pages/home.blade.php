<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 24.11.15
 * Time: 12:33
 */
 -->

@extends('layouts.master')

@section('content')

    <h1>Добро пожаловать</h1>
    <p class="lead">Добро пожалоавать! Для добавления продуктов,их просмотра Вы можете нажать необходимую кнопку.</p>
    <hr>

    <a href="{{ route('products.index') }}" class="btn btn-info">Просмотр продуктов</a>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Создать новый продукт</a>

@stop