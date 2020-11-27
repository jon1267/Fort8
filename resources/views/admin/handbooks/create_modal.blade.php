<div class="modal fade" id="modal-create" style="display: none;" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Добавить данные</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{--<form action="{{ isset($model->id) ? route('admin.good.update', $model->id) : route('admin.good.store') }}" method="post" id="good-form">--}}
                <form action="{{ route($storeRoute) }}" method="post" id="create-form">
                    @csrf
                    <div class="form-group">
                        <label for="title">Наименование</label>
                        <input class="form-control" type="text"
                               id="title" name="title" placeholder="Введите наименование" >
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <input class="form-control" type="text"
                               id="description" name="description" placeholder="Введите описание" >
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="createFormSubmit()">
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
function createFormSubmit() {
    document.getElementById('create-form').submit();
}
</script>
