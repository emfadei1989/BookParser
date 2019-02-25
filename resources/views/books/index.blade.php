@extends('layouts.app')

@section('content')

    <div class="container">
        <form class="form-horizontal" method="get" action="{{route('books.index')}}">
            <div class="form-group row">
                <div class="col-sm-10">
                    <input class="form-control" id="search" type="text" name="search"
                           placeholder="Поиск по названию или автору">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Поиск</button>
                </div>
            </div>


        </form>


        <h1>Список книг</h1>
        <table class="table">
            <thead>
            <th>Наименование</th>
            <th>Авторы</th>
            <th>Год издания</th>
            <th>Цена</th>
            </thead>
            <tbody>
            @forelse($books as $book)
                <tr>
                    <td>
                        <a href="{{$book->link}}">
                            <img style="width: 30px; margin-right: 10px" src="{{$book->image}}" alt="">
                            {{$book->name}}
                        </a>
                    </td>
                    <td>{{$book->authors}}</td>
                    <td>{{$book->year}}</td>
                    <td>{{$book->price}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center"><h2>Данные отсутствуют</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">
                    <ul class="pagination pull-right">
                        {{$books->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
