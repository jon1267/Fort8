<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Добавить данные</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

{{--
    вот тут и непонятка...должны быть и update & store !!!
    <form  action="{{ (isset($user)) ? route('admin.user.update', $user) : route('admin.user.store') }}" method="post">
--}}
                {{--<form action="{{ isset($model->id) ? route('admin.good.update', $model->id) : route('admin.good.store') }}" method="post" id="good-form">--}}
                <form action="{{ route('admin.good.update', $model->id) }}" method="post" id="good-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Наименование</label>
                        <input class="form-control" type="text"
                               id="title" name="title" placeholder="Введите наименование"
                               value="{{ $model->title }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <input class="form-control" type="text"
                               id="description" name="description" placeholder="Введите описание"
                               value="{{ $model->description }}"
                        >
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="formSubmit()">
                    <i class="far fa-save mr-2"></i>Сохранить данные
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
function formSubmit() {
    document.getElementById('good-form').submit();
}
</script>
