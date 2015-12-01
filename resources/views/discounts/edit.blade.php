<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 30.11.15
 * Time: 14:29
 */
 -->
@extends('layouts.master')

@section('content')

    <h1>Редактируемая скидка - {{$discount->name}}</h1>
    <p class="lead">Для редактировния измените значения полей. <a href="{{ route('discounts.index') }}">Вернуться к списку скидок.</a></p>
    <hr>

    @include('partials.alerts.errors')

    {!! Form::model($discount, [
    'method' => 'PATCH',
    'route' => ['discounts.update', $discount->id]
    ]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Текущая скидка:', ['class' => 'control-label']) !!}
        {!! Form::text('name',  null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Описание:', ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('percent', 'Процент скидки:', ['class' => 'control-label']) !!}
        {!! Form::text('percent', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('quantity', 'Количество товара, с которого начинется действие скидки:', ['class' => 'control-label']) !!}
        {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Обновить скидку', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

@stop