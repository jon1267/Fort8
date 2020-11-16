<form action="{{ route('admin.filter.data') }}" method="post">
    @csrf
    <div class="form-group d-flex ">
        <div class="mr-3">
            <label>Дата от:</label>
            <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                <input type="text" name="date_from" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
                <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="mr-4">
            <label>Дата до:</label>
            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                <input type="text" name="date_to" class="form-control datetimepicker-input" data-target="#reservationdate2"/>
                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="mr-4">
            <label>Сортировка:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="order_by" id="desc"  value="desc" checked>
                <label class="form-check-label">По убыванию</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="order_by" id="asc"  value="asc" >
                <label class="form-check-label">По возрастанию</label>
            </div>
        </div>

        <div class="mr-4">
            <label for="exampleFormControlSelect1">Инструменты (используйте Ctrl + Click)</label>
            <select multiple="multiple" class="form-control" id="instrument-select" name="instrument[]">
                @foreach($forSelect as $item)
                    <option value="{{ $item->id }}">{{ $item->title . ' - ' . $item->description}} </option>
                @endforeach
            </select>
        </div>

        <div class="mr-4">
            <label>&nbsp;</label>
            <button type="submit" class="form-control btn btn-primary">Выбрать</button>
        </div>
    </div>
</form>
