<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 24.11.15
 * Time: 15:15
 */
 -->
@extends('layouts.master')

@section('content')

    <h1>{{ $product->name }}</h1>
    <h3>Главная категория: {{$parent_category->name}}, <br/> Подкатегория: {{$category->name}}.</h3>

    <h2>Установленные скидки:</h2>
    @foreach ($discounts as $discount)
        <b>{{ $discount->disc_name }}: {{ $discount->disc_description }}</b><br/>
    @endforeach
    <br/>
    <p class="lead">{{ $product->shot_description }}</p>
    <p class="lead">{{ $product->full_description }}</p>
    <hr>
    @foreach ($images as $image)
        <div class="col-md-4">
                <a href="#" class="thumbnail">
                    {!! Html::image($image->path, 'Картинка', array('class' => 'thumbnail', 'style' => 'height:228px;')) !!}
                </a>
        </div>
    @endforeach

    <div class="row">
        <table style="width:100%">
            <tr>
                <td>
                    <a href="{{ route('products.index') }}" class="btn btn-info">Вернуться ксписку продуктов</a>
                </td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Редактировать продукт</a>
                </td>
                <td>
                    {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['products.destroy', $product->id]
                    ]) !!}
                    {!! Form::submit('Удалить продукт?', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        </table>
    </div>

@stop