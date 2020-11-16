@extends('admin.date-picker')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header align-items-baseline">
                            <!--<h5>Выборка</h5>-->
                            @include('admin.biddings.find_form', $forSelect)
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            @if($instruments)

                                @foreach($data as $instrumentName)
                                <h3>{{ $instrumentName['instrument']['title'] }}
                                    <small class="ml-4">{{ $instrumentName['decode'][0] }}</small>
                                    <div>
                                        <small>{{ $instrumentName['decode'][1] }}</small>
                                        <small class="ml-5">{{ $instrumentName['decode'][2] }}</small>
                                    </div>
                                </h3>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <!-- style="width: 10px" -->
                                        <th>ID</th>
                                        <th scope="col">Дата торгов</th>
                                        <th scope="col">Рыночная цена</th>
                                        <th scope="col">Объем торгов</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- тут чудеса! не $instrument->bidding->trade_at, а этот цирк! но в релейшене был массв [0] с множеством связ. записей...-->
                                    @foreach($instruments as $instrument)
                                        <tr class="text-center">
                                            <td>{{ $instrument->id }}</td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $instrument->trade_at)->format('d.m.Y') }}</td>
                                            {{--<td>{{ $instrument->trade_at->format('d.m.Y') }}</td>--}}
                                            <td>{{ number_format($instrument->price, 0, '', ' ') }}</td>
                                            <td>{{ $instrument->volume }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @endforeach
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                        {{-- $instruments->links() --}}

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

