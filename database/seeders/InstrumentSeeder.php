<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instruments;
use App\Models\Goods;
use App\Models\Basis;
use App\Models\Lots;
use App\Models\Delivery;

class InstrumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Fill table instruments
         */
        $instruments = [
            'A592DZM060F', 'A592NOV060F', 'A595DZM060F', 'A595NOV060F', 'A598DZM060F',
            'DE5ENOV065F', 'DSC5ANK065F', 'DSC5DZM065F', 'DSC5NOV065F', 'DW25ANK065F', 'DW25DZM065F', 'DW25NOV065F',
            'JET-ANK065F', 'JET-NOV065F', 'M10ADZM065F', 'M30AANK065F', 'M30ANOV065F', 'TKM7KOB065F',
        ];
        $type = ['Бензин','Дизельное топливо','Керосин','Мазут'];

        for($i = 0; $i < count($instruments); $i++) {

            if($i < 5) $description = $type[0];
            elseif ($i > 4 && $i < 12 ) $description = $type[1];
            elseif ($i > 11 && $i < 14 ) $description = $type[2];
            else $description = $type[3];

            Instruments::create([
                'title' => $instruments[$i],
                'description' => $description,
            ]);
        }
        /**
         * Fill table goods
         */
        $goods = [
            'A592' => 'Бензин (АИ-92-К5) ГОСТ 32513-2013',
            'A595' => 'Бензин (АИ-95-К5) ГОСТ 32513-2013',
            'A598' => 'Бензин (АИ-98-К5) ГОСТ 32513-2013',
            'DSC5' => 'ДТ ЕВРО сорт C (ДТ-Л-К5) минус 5 ГОСТ 32511-2013 (EN590:2009)',
            'DW25' => 'ДТ ЕВРО класс 2 (ДТ-З-К5) минус 32 ГОСТ 32511-2013 (EN590:2009)',
            'DE5E' => 'ДТ ЕВРО сорт Е (ДТ-Е-К5) минус 15 ГОСТ 32511-2013 (EN590:2009)',
            'JET-' => 'Топливо для реактивных двигателей ТС-1 высший сорт ГОСТ 10227-86',
            'M10A' => 'Мазут топочный М100* ГОСТ 10585-2013; дополнительные качественные характеристики',
            'M30A' => 'Мазут топочный М100 1,5 малозольный* ГОСТ 10585-2013; дополнительные качественные характеристики',
            'TKM7' => 'Мазут топочный TKM-16* ТУ 38.401-58-74-2005 ; дополнительные качественные характеристики',
        ];
        foreach($goods as $key => $value) {
            Goods::create([
                'title' => $key,
                'description' => $value,
            ]);
        }

        /**
         * Fill table basis
         * кол-во элементов во всех 3-ех массивах равны !
         */
        $basis1 = ['DZM','NOV','ANK','KOB',];
        $basis2 = ['Дземги, Дальневосточная ЖД','Новая Еловка, Красноярская ЖД','Ангарск - группа станций','Комбинатская, Западно-Сибирская ЖД',];
        $basis3 = ['КОМСОМОЛЬСК','АЧИНСК','АНГАРСК','ОМСК',];
        for ($i = 0; $i < count($basis1); $i++) {
            Basis::create([
                'title' => $basis1[$i],
                'description' => $basis2[$i],
                'display' => $basis3[$i],
            ]);
        }

        /**
         * Fill table lots
         */
        $lots = [
            '060' => '60 тонн',
            '065' => '65 тонн',
        ];
        foreach ($lots as $key => $value) {
            Lots::create([
                'title' => $key,
                'description' => $value
            ]);
        }

        /**
         * Fill table delivery
         */
        Delivery::create([
            'title' => 'F',
            'description' => 'Франко-вагон станция отправления'
        ]);
    }
}
