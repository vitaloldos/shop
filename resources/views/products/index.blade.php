<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 24.11.15
 * Time: 12:45
 */
 -->

@extends('layouts.master')

@section('content')

    <h1>Список продуктов</h1>
    <p class="lead">Здесь Вы видите весь список продуктов. <a href="{{ route('products.create') }}" class="btn btn-primary">Добавить новый продукт</a></p>
    <hr>
    <div class="table-responsive">
    {!! Datatable::table()
    ->addColumn(array(
    '№ пп',
    'Название',
    'Краткое описание продукта',
    'Создан',
    'Действия'
    ))->setUrl(route('api.products'))
      ->setOptions(array(
            'language' => array(
        "url" => "assets/js/lang/datatables.ru.lang")))
    ->render() !!}
    </div>

@stop