<?php

namespace App\Services\DecodeInstrument;

use App\Models\Instruments;
use App\Models\Goods;
use App\Models\Basis;
use Illuminate\Support\Facades\DB;

class DecodeInstrument
{
    /**
     * Расшифровываем инструмент (A592DZM060F): первые 4 цифры - товар (бензин А5 92-й)
     * Следующие 3 цифры код железной дороги, и ст. назначения. Возвращаем как массив строк.
     * @param Instruments $instrument
     * @return array
     */
    public function handle(Instruments $instrument)
    {
        $good = Goods::where('title', mb_substr($instrument->title, 0, 4))->first();
        $basis = Basis::where('title', mb_substr($instrument->title, 4, 3))->first();
        return [
            $good->description ?? null,
            $basis->description ?? null,
            $basis->display ?? null,
        ];
    }

    public function handleBy(int $instrumentId)
    {
        $instrument = Instruments::where('id', $instrumentId)->first();

        $good = Goods::where('title', mb_substr($instrument->title, 0, 4))->first();
        $basis = Basis::where('title', mb_substr($instrument->title, 4, 3))->first();

        return [
            $instrument->title ?? null,
            $good->description ?? null,
            $basis->description ?? null,
            $basis->display ?? null,
        ];
    }

    /**
     * Метод выше расшифровка 1-го инструмента, это возвращает всю табл. торгов (bidding)
     * но пристегивает те-же расшифровки, к каждой записи (излишество, надо к каждой 11-ой)
     * @return \Illuminate\Support\Collection
     */
    public function allHandle()
    {
        return DB::table('bidding')
            ->select('instrument_id', 'trade_at', 'price', 'volume',
                'instruments.title', 'goods.description', 'basis.description', 'basis.display')
            ->leftJoin('instruments', 'instruments.id' , '=' ,'bidding.instrument_id')
            ->leftJoin('goods', 'goods.title', '=', DB::raw('SUBSTR(instruments.title, 1, 4)'))
            ->leftJoin('basis', 'basis.title', '=', DB::raw('SUBSTR(instruments.title, 5, 3)'))
            ->get();
    }

/* это работает в ПМА
    SELECT instrument_id, trade_at, price, volume, instruments.title, goods.description
    FROM `bidding`
    LEFT JOIN `instruments` ON instruments.id = bidding.instrument_id
    LEFT JOIN `goods` ON goods.title = SUBSTR(instruments.title, 1, 4);

    и это тоже
    SELECT instrument_id, trade_at, price, volume, instruments.title, goods.description, basis.description, basis.display
    FROM `bidding`
    LEFT JOIN `instruments` ON instruments.id = bidding.instrument_id
    LEFT JOIN `goods` ON goods.title = SUBSTR(instruments.title, 1, 4)
    LEFT JOIN `basis` ON basis.title = SUBSTR(instruments.title, 5, 3);

*/
}
