<!--
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 24.11.15
 * Time: 15:36
 */
 -->
@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif