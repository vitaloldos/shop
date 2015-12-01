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

    <h1>Список категорий</h1>

    <p class="lead">Здесь Вы видите весь список категорий. <a href="{{ route('categories.create') }}" class="btn btn-primary">Добавить новую категорию</a></p>
    <hr>
    <div class="table-responsive">
        {!! Datatable::table()
        ->addColumn(array(
        '№ пп',
        'Категории',
        'Главная категория',
        'Создан',
        'Действия'
        ))->setUrl(route('api.categories'))
        ->setOptions(array(
        'language' => array(
        "url" => "assets/js/lang/datatables.ru.lang")))
        ->render() !!}
    </div>

@stop