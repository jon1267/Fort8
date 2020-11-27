<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Instruments;
use App\Models\Bidding;
use App\Services\DecodeInstrument\DecodeInstrument;
use App\Services\FilterDataService\FilterData;


class BiddingDataController extends Controller
{
    private $decode;

    public function __construct(DecodeInstrument $decode)
    {
        $this->decode = $decode;
    }

    // ok данные есть
    public function instruments()
    {
        $title = 'Данные торгов';
        /*  это делает то чтоя хотел: в 1-ой коллекции все по инструменту, расшифровка инструмента
            расшифровка базаса, но тут уже не прикрутить пагинацию (???)
        $instruments = Instruments::with('bidding')->get()->map(function ($item) {
            $item['decode'] = $this->decode->handle($item);
            return collect($item,$item['decode']);
        });
        */
        $instruments = Instruments::with('bidding')->paginate(1);
        $forSelect = Instruments::select('id', 'title', 'description')->get();

        $instrumentsDecode = [];

        foreach ($instruments as $key => $instrument) {
            $instrumentsDecode[$key]['instrument'] = $instrument;
            $instrumentsDecode[$key]['decode'] =  $this->decode->handle($instrument);
        }

        // наворочено ? но строка ниже - все решает для всех данных и с пагинацией :)
        $plantInstruments = $this->decode->allHandle()->orderBy('instrument_id')
            ->latest('trade_at')->get(); // paginate(15);
        dd($plantInstruments);
        //return view('admin.biddings.biddings_content', ['title' => $title,'instruments' => $instruments]);

        return view('admin.biddings.bid_content', [
            'title' => $title,
            'instruments' => $instruments,
            'data' => $instrumentsDecode,
            'forSelect' => $forSelect,
        ]);
    }

    public function filter(Request $request)
    {
        $r = $request->except('_token');
        if(!empty($r['date_from'])) {
            $r['date_from'] = $this->datepickerToMysql($r['date_from']);
        }
        if(!empty($r['date_to'])) {
            $r['date_to'] = $this->datepickerToMysql($r['date_to']);
        }
        //dd($r);

        $filter = FilterData::init('bidding',$r);
        $query = $filter
            ->dateRangeFilter('trade_at')
            ->multiSelectFilter('instrument_id', $r['instrument'])
            //->fieldFilter('instrument_id', $r['instrument'])//в селекте выбирается одно знач. (не multi select)
            ->orderFilter('trade_at', $r['order_by']);


        $title = 'Выборка данных:  c '. $r['date_from'] . ' по ' . $r['date_to'];
        $instruments = $query->get();
        $forSelect = Instruments::select('id', 'title', 'description')->get();

        $filteredInstruments = $instruments->unique('instrument_id');
        $instrumentsDecode = [];
        foreach ($filteredInstruments as $key => $instrument) {
            $instrumentsDecode[$key]['instrument'] = $instrument;
            $instrumentsDecode[$key]['decode'] =  $this->decode->handleBy($instrument->instrument_id);
        }
        //dd($instruments, $instrumentsDecode);

        return view('admin.biddings.biddings_content', [
            'title' => $title,
            'instruments' => $instruments,
            'data' => $instrumentsDecode,
            'forSelect' => $forSelect,
        ]);

    }

    /**
     * Datepicker (jquery и AdminLTE3) возвращает дату как строку 'm/d/Y' те 'месяц/день/год'
     * Этот метод делает нормальную мускульную дату в формате 'Y-m-d' но для
     * @param string $value
     * @return string
     */
    private function datepickerToMysql(string $value)
    {
        return Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }
}
