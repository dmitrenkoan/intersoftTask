@extends('adminTemplate')


@section('content')
            <div class="row">
                <a href="/admin/note/create" class="btn btn-sm btn-success">Создать новый пост</a>
            </div>
            <div class="row header">
                <div class="col-sm-3 title">
                    <p>Заголовок</p>
                </div>
                <div class="col-sm-2 title">
                    <p>Автор</p>
                </div>
                <div class="col-sm-2 title">
                    <p>Дата публикации</p>
                </div>
                <div class="col-sm-2 buttons">

                </div>
                <div class="col-sm-2 buttons">

                </div>
            </div>
            @if(!empty($posts))
                @foreach($posts as $postItem)
                    <div class="row item">
                        <div class="col-sm-3 title">
                            <p>{{$postItem->title}}</p>
                        </div>
                        <div class="col-sm-2 title">
                            <p>{{$postItem->user->name}}</p>
                        </div>
                        <div class="col-sm-2 title">
                            <p>{{$postItem->publication_date}}</p>
                        </div>
                        <div class="col-sm-2 buttons right">
                            <a href="/admin/note/{{$postItem->id}}/edit" class="btn btn-sm btn-primary">Изменить</a>
                        </div>
                        <div class="col-sm-2 buttons left">
                            <form action="/admin/note/{{$postItem->id}}" method="POST">
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-sm btn-danger"  value="Удалить">
                            </form>

                        </div>
                    </div>
                @endforeach

                <div class="row center">
                    {{ $posts->links() }}
                </div>
            @endif

@endsection