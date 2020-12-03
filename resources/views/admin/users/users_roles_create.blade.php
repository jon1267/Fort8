@extends('admin.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-8">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="m-0">{{ (isset($userr)) ? 'Обновление пользователя ' . $userr->email : 'Создание пользователя' }}</h5>
                        </div>
                        <div class="card-body">

                            <!-- -->
                            <form  action="{{ (isset($userr)) ? route('admin.userr.update', $userr) : route('admin.userr.store') }}" method="post">
                                @csrf
                                @if(isset($userr))
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="name">Имя пользователя</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           id="name" name="name" placeholder="Имя пользователя"
                                           value="{{(isset($userr->name)) ? $userr->name : old('name')}}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="text"
                                           id="email" name="email" placeholder="Email"
                                           value="{{(isset($userr->email)) ? $userr->email : old('email')}}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                @if(!isset($userr))
                                <div class="form-group">
                                    <label for="password">Пароль </label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                           id="password" name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @endif

                                <div class="mb-3">
                                    @foreach($roles as $role)
                                        <div class="form-check">
                                            <input class="form-check-input" name="roles[]"
                                                   type="checkbox" value="{{ $role->id }}" id="{{ $role->name }}"
                                            @isset($userr) @if(in_array($role->id, $userr->roles->pluck('id')->toArray())) checked @endif @endisset
                                            >
                                            <label class="form-check-label" for="{{ $role->name }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> <i class="far fa-save mr-2"></i>Сохранить </button>
                                    <a href="{{ route('admin.userr.index') }}" class="btn btn-info ml-2"> <i class="fas fa-sign-out-alt mr-2"></i>Отмена</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

