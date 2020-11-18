@extends('admin.date-picker')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header align-items-baseline">
                            <!--<h5>Выборка</h5>-->
                            @include('admin.biddings.find_form')
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            @if($instruments)

                                @foreach($data as $instrument)
                                <h3>{{ $instrument['instrument']['title'] }}
                                    <small class="ml-4">{{ $instrument['decode'][0] }}</small>
                                    <small class="ml-4">{{ $instrument['decode'][1] }}</small>
                                    <small class="ml-4">{{ $instrument['decode'][2] }}</small>
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
                                    <!-- format('d.m.Y') тут чудеса! не $instrument->bidding->trade_at, а этот цирк! но в релейшене был массв [0] с множеством связ. записей...-->
                                    @foreach($instrument['instrument']['bidding'] as $bid)
                                        <tr class="text-center">
                                            <td>{{ $bid['id'] }}</td>
                                            <td>{{ $bid['trade_at']->format('d.m.Y') }}</td>
                                            <td>{{ $bid['price'] }}</td>
                                            <td>{{ $bid['volume'] }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @endforeach
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $instruments->links()  }}
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

