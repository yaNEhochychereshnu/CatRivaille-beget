@extends('layout')
@section('content')
<h1 class="text-center mt-5">Категории</h1>
<div class="text-center">
    <a href="{{route('categories.create')}}" class="btn btn-primary my-3">Добавить новую категорию</a>
</div>
@foreach ($categories as $category)
<div class="text-center mb-3">
    <h3>{{$category->title}}</h3>
    <div>
        <a href="{{route('categories.edit', $category)}}" class="btn btn-primary mr-2">Изменить</a>
        <form action="{{route('categories.destroy', $category)}}" method="post" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
    </div>
</div>
    @endforeach
@endsection
