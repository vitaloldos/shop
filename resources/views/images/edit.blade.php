<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 29.11.15
 * Time: 21:31
 */
 -->

@extends('layouts.master')

@section('content')

    <h1>Редактируйте картинку</h1>
    <h3>Файл: {{ $image->path }}</h3>
    <hr>

    {!! Html::image($image->path, 'Картинка', array('class' => 'thumbnail', )) !!}
    <div class="row">
        <div class="col-md-6 text-left ">
            <table>
                <tr>
                   <td style="width:150px">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Вернуться</a>
                    </td>
                    <td style="width:350px">
                        {!! Form::open([
                        'method' => 'post',
                        'files' => true,
                        'route' => ['images.change']
                        ]) !!}
                        {!! Form::file('images', array('multiple'=>true)) !!}
                    </td>
                    <td>
                        {!! Form::hidden('id', $image->id) !!}
                        {!! Form::hidden('path', $image->path) !!}
                        {!! Form::submit('Заменить картинку?', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
            </table>
        </div>

        <div class="col-md-6 text-right">
            {!! Form::open([
            'method' => 'DELETE',
            'route' => ['images.destroy', $image->id]
            ]) !!}
            {!! Form::submit('Удалить картинку?', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop