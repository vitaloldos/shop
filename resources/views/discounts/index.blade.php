<!--
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 30.11.15
 * Time: 14:29
 */
 -->
@extends('layouts.master')

@section('content')

    <h1>Список скидок</h1>

    <p class="lead">Здесь Вы видите весь перечеь скидок. <a href="{{ route('discounts.create') }}" class="btn btn-primary">Добавить новую скидку</a></p>
    <hr>
    <div class="table-responsive">
        {!! Datatable::table()
        ->addColumn(array(
        '№ пп',
        'Назвние',
        'Описание',
        'Процент скидки',
        'Мин.количество товра',
        'Создан',
        'Действия'
        ))->setUrl(route('api.discounts'))
        ->setOptions(array(
        'language' => array(
        "url" => "assets/js/lang/datatables.ru.lang")))
        ->render() !!}
    </div>

@stop