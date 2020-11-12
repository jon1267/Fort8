@extends('admin.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-8">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="m-0">{{ (isset($post)) ? 'Обновление данных' : 'Введите данные' }}</h5>
                        </div>
                        <div class="card-body">

                            <!-- -->
                            <form  action="{{ (isset($post)) ? route('admin.post.update', $post) : route('admin.post.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(isset($post))
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="name">Заголовок новости</label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text"
                                           id="title" name="title" placeholder="Заголовок новости"
                                           value="{{(isset($post->title)) ? $post->title : old('title')}}">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="body">Текст новости</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" rows="3"
                                           id="body" name="body" placeholder="Текст новости">{{(isset($post->body)) ? $post->body : old('body')}}</textarea>
                                    @error('body')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                @if(isset($post) && (!is_null($post->img)))
                                    <div class="form-group">
                                        <label for="old_img"><small>Старое изображение</small></label>
                                        <div><img id="old_img" src="{{asset('img/'.$post->img)}}" width="100" alt="Image"></div>
                                    </div>
                                @endif

                                <div class="form-group ">
                                    <label for="exampleInputFile">Изображение новости</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('img') is-invalid @enderror" id="img" name="img" aria-describedby="customFileInput">
                                            <label class="custom-file-label" for="customFileInput">Выберите изображение</label>
                                        </div>
                                        <!--<div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="customFileInput">Upload</button>
                                        </div>-->
                                    </div>
                                    @error('img')
                                        <!-- нада style="display: inline-block", т.к. custom-file-input где-то ставит d-none -->
                                        <span class="invalid-feedback" style="display: inline-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> <i class="far fa-save mr-2"></i>Сохранить новость </button>
                                    <a href="{{ route('admin.post.index') }}" class="btn btn-info ml-2"> <i class="fas fa-sign-out-alt mr-2"></i>Отмена</a>
                                </div>
                            </form>
                            <!-- -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
