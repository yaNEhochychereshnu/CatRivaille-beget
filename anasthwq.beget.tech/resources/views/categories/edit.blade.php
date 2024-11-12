@extends('layout')
@section('content')
    <form method="POST" action="{{route('categories.update', $category)}}">
        @csrf
        @method('PUT')
        <label for="title" class="form-label">Название категории</label>
        <input type="text" class="form-control" id="title" name="title" value="{{$category->title}}" required>
        <button type="submit" class="btn btn-primary">Изменить категорию</button>
    </form>
@endsection
