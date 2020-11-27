@extends('admin.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-baseline">
                            <h3 class="card-title">Все новости</h3>
                            <div>
                                <a href="{{ route('admin.post.create') }}" class="btn btn-primary ml-4">Добавить новость</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            @if($posts)
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Text</th>
                                    <th>Image</th>
                                    <!-- style="width: 100px" устраняет: при сужении кнопы вылазят из ячеек таблицы -->
                                    <th style="width: 100px;">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ Str::limit($post->body) }}</td>
                                        <td>
                                            @if(isset($post->img))
                                                <img src="{{asset('img/'.$post->img) }}" width="70"  alt="image">
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.post.destroy', $post) }}" class="form-inline " method="POST" id="post-delete-{{$post->id}}">
                                                <div class="form-group">
                                                    {{-- ссылка независима, к форме не привязана, просто чтоб кнопы были в строку --}}
                                                    <a href="{{ route('admin.post.edit', $post) }}" class="btn btn-primary btn-sm mr-1" title="Редактировать пост"> <i class="fas fa-pen"></i> </a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm" href="#" role="button" title="Удалить пост"
                                                            onclick="confirmDelete('{{$post->id}}', 'post-delete-')" >
                                                        <i class="fas fa-trash" ></i>
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
                            {{ $posts->links() }}
                            <!--<ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>-->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
