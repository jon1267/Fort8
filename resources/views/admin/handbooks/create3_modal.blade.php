<div class="modal fade" id="modal3-create" style="display: none;" >
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
                <form action="{{ route($storeRoute) }}" method="post" id="create3-form">
                    @csrf
                    <div class="form-group" id="title-div">
                        <label for="title">Наименование</label>
                        <input class="form-control  @error('title') is-invalid @enderror" type="text"
                               id="create3-title" name="title" placeholder="Введите наименование" >
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group" id="description-div">
                        <label for="description">Описание</label>
                        <input class="form-control @error('description') is-invalid @enderror" type="text"
                               id="create3-description" name="description" placeholder="Введите описание" >
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group" id="display-div">
                        <label for="display">Отображение</label>
                        <input class="form-control @error('display') is-invalid @enderror" type="text"
                               id="create3-display" name="display" placeholder="Введите отображение" >
                        @error('display')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-primary" id="create3-save-button" >
                    <i class="far fa-save mr-2"></i>Сохранить данные
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

