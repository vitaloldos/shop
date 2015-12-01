<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 30.11.15
 * Time: 14:30
 */
 -->
@extends('layouts.master')

@section('content')

    <h1>Скидка: {{ $discount->name }}</h1>
    <hr>

    <p class="lead">Описание скидки: <br/>{{ $discount->description }}</p>
    <p class="lead">Процент скидки: {{ $discount->percent }}%</p>
    <p class="lead">Минимальное количество товара, при котором начинается действие скидки: {{ $discount->quantity }}
    @if ( $discount->quantity == '1')
        штука.
    @elseif ($discount->quantity == '5' OR $discount->quantity == '10' OR $discount->quantity == '50')
        штук.
    @else
        штуки.
    @endif
    </p>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('discounts.index') }}" class="btn btn-info">Вернуться к списку скидок</a>
            <a href="{{ route('discounts.edit', $discount->id) }}" class="btn btn-primary">Редактировать скидку</a>
        </div>
        <div class="col-md-6 text-right">
            {!! Form::open([
            'method' => 'DELETE',
            'route' => ['discounts.destroy', $discount->id]
            ]) !!}
            {!! Form::submit('Удалить скидку?', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop