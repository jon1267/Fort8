{{-- Это таблица с 2-мя значащими колонками (title, description) по какой-то модели лары
надо передать как параметры: 1) $models - набор данных 2) Ларины роуты 3-шт на создание,
редактирование и удаление типа ('post.create', 'post.edit' это ->name('post...')) роутов.
имена дб точно эти: $createRoute, $editRoute, $destroyRoute --}}
@extends('admin.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header d-flex align-items-baseline">
                            <h3 class="card-title">Все данные</h3>
                            <div>
                                <!-- data-toggle="modal" data-target="#modal-create" -->
                                <a href="{{ route($createRoute) }}" class="btn btn-primary ml-4"
                                   onclick="showCreateModal()" > Добавить данные </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            @if($models)
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <!-- style="width: 100px" устраняет: при сужении кнопы вылазят из ячеек таблицы -->
                                        <th style="width: 100px;">Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($models as $model)
                                        <tr>
                                            <td>{{ $model->id }}</td>
                                            <td>{{ $model->title }}</td>
                                            <td>{{ $model->description }}</td>
                                            {{--<td>{{ Str::limit($model->description) }}</td>--}}

                                            <td>
                                                <form action="{{ route($destroyRoute, $model->id) }}" class="form-inline " method="POST" id="model-delete-{{$model->id}}">
                                                    <div class="form-group">
                                                        {{-- ссылка независима, к форме не привязана, просто чтоб кнопы были в строку  data-toggle="modal" data-target="#modal-update" --}}
                                                        <a href="{{ route($editRoute, $model->id) }}" class="btn btn-primary btn-sm mr-1"
                                                           title="Редактировать данные" onclick="showUpdateModal('{{ $model->id }}', '{{ $model->title }}', '{{ $model->description }}')">
                                                            <!-- style="line-height: 1.5" тк при подключении модалок оно становится 1 и верстка ползет (bootstrap 4.4) -->
                                                            <i class="fas fa-pen" style="line-height: 1.5"></i>
                                                        </a>

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger btn-sm" href="#" role="button" title="Удалить данные"
                                                                onclick="confirmDelete('{{ $model->id }}', 'model-delete-')" >
                                                            <i class="fas fa-trash" style="line-height: 1.5"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            @endif
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            @if(method_exists($models, 'links'))
                                {{ $models->links() }}
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@include('admin.handbooks.create_modal')
@include('admin.handbooks.update_modal')

<script>
    function showUpdateModal(id, title, description) {
        console.log(id, title, description);
        event.preventDefault();
        $('#update-id').val(id);
        $('#update-title').val(title);
        $('#update-description').val(description);
        $('#modal-update').css('display', 'block');
        $('#modal-update').modal('show');
    }
    function showCreateModal() {
        event.preventDefault();
        $('#update-title').val('');
        $('#update-description').val('');
        $('#modal-create').css('display', 'block');
        $('#modal-create').modal('show');
    }
</script>
