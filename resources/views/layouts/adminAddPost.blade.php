@extends('adminTemplate')


@section('content')
    <div class="container">
        <h2>Добавить новый пост</h2>
        <form action="/admin/note"  method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input id="title" class="form-control" type="text" name="title" value="">
            </div>
            <div class="form-group">
                <label for="picture">Картинка:</label>

                    <p><img class="img-thumbnail" src="{{asset('images/no-photo.png')}}" alt="note_picture" style="width:200px;height:150px;"></p>

                <input id="picture" class="form-control-file" type="file" name="picture" value="">
            </div>
            <div class="form-group">
                <label for="publication_date">Дата публикации:</label>
                <input id="publication_date" class="form-control" type="date" name="publication_date" value="">
            </div>
            <div class="form-group">
                <label for="author_id">Автор:</label>
                <select name="user_id" class="form-control">
                    <option value="">Выберите вариант</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="detail_text">Текст статьи:</label>
                <textarea id="detail_text" name="detail_text" class="form-control">

                </textarea>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>

        </form>
    </div>

@endsection
