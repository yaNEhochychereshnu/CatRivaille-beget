@extends('layout')
@section('content')
    <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
        @csrf
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" name="title" required>
        <label for="title" class="form-label">Тип товара</label>
        <select name="category_id" id="category_id" class="form-select">
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
        <label for="title" class="form-label">Материал</label>
        <input type="text" class="form-control" id="material" name="material" required>
        <label for="title" class="form-label">Размер</label>
        <input type="text" class="form-control" id="size" name="size" required>
        <label for="title" class="form-label">Цена</label>
        <input type="text" class="form-control" id="price" name="price" required>
        <label for="title" class="form-label">Количество</label>
        <input type="text" class="form-control" id="qty" name="qty" required>
        <label for="img" class="form-label">Изображение</label>
        <input type="file" class="form-control" id="img" name="img" required>
        <button type="submit" class="btn btn-primary">Добавить новый товар</button>
    </form>
@endsection
