@extends('adminTemplate')


@section('content')
    <div class="container">
        <h2>Редактировать элемент: <b>{{$post->title}}</b></h2>
        <form action=""  method="POST" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input id="title" class="form-control" type="text" name="title" value="{{$post->title ? $post->title :""}}">
            </div>
            <div class="form-group">
                <label for="picture">Картинка:</label>
                @if(!empty($post->picture_id))
                    <p><img class="img-thumbnail" src="{{asset($post->picture->path)}}" alt="note_picture" style="width:200px;height:150px;"></p>
                    <p>
                        <label for="removePicture">Убрать фото</label>
                        <input type="checkbox" name="remove_picture" id="removePicture" value="Y"/>
                    </p>
                    <p id="warning-picture" style="display:none">*Изменения вступят в силу после нажатия кнопки сохранить</p>
                @else
                    <p><img class="img-thumbnail" src="{{asset('images/no-photo.png')}}" alt="note_picture" style="width:200px;height:150px;"></p>
                @endif
                <input id="picture" class="form-control-file" type="file" name="picture" value="">
            </div>
            <div class="form-group">
                <label for="publication_date">Дата публикации:</label>
                <input id="publication_date" class="form-control" type="date" name="publication_date" value="{{$post->publication_date}}">
            </div>
            <div class="form-group">
                <label for="author_id">Автор:</label>
                <select name="user_id" class="form-control">
                    <option value="">Выберите вариант</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}" {{$post->user_id==$user->id ? 'selected' : ''}}>{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="detail_text">Текст статьи:</label>
                <textarea id="detail_text" name="detail_text" class="form-control">
                    {{$post->detail_text}}
                </textarea>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>

        </form>
    </div>

@endsection
