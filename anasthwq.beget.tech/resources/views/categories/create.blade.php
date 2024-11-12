@extends('layout')
@section('content')
    <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
        @csrf
        <label for="title" class="form-label">Название категории</label>
        <input type="text" class="form-control" id="title" name="title" required>
        <button type="submit" class="btn btn-primary">Добавить новую категорию</button>
    </form>
@endsection
