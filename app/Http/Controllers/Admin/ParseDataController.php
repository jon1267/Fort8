<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Instruments;
use App\Models\Bidding;

class ParseDataController extends Controller
{
    public function getInstrumentData()
    {
        $instruments = Instruments::select('id','title')->get();
        $isExist = null;
        $res = [];
        if ($instruments) {
            foreach ( $instruments as $key => $instrument) {
                //$res[$instrument->title] = $this->parse($instrument->id, $instrument->title);
                $res[$key] = $this->parse($instrument->id, $instrument->title);

                // попытка не вставлять строки к-рые уже есть...
                foreach ($res[$key] as $item ) {
                    $isExist = Bidding::where([
                        ['instrument_id', $item['instrument_id']],
                        ['trade_at' , $item['trade_at']->format('Y-m-d')],
                        ['price', $item['price']],
                        ['volume', $item['volume']],
                    ])->first();

                    if (!$isExist) {
                        Bidding::insert($item);
                        $isExist = null;
                    }
                }

                //тупая вставка всего спарсенного (вставл. и строки к-рые уже есть :)
                //Bidding::insert($res[$key]);
            }
        }

        //$res = $this->parse(1,'A592DZM060F'); //this for debug one request
        //dd($res, $instruments);
        return redirect()->back();

    }

    public function parse(int $instrumentId, string $instrument)
    {
        $url = 'https://spimex.com/markets/oil_products/instruments/list/detail.php';
        $response = Http::get($url, [
            'code' => $instrument,
        ]);

        if($response->status() == 200) {

            $str = $response->body();

            if (preg_match('|<div class="market-price__value"[^>]*?>(.*?)</div>|si', $str, $arr)) $price = trim($arr[1]);

            $price=str_replace('&nbsp;', '', explode(' ',$price)[0]);
            //print_r($price);


            $pattern = '|<table class="results_table table-light" width="100%">(.*?)</table>|';
            preg_match_all($pattern, $str, $table);

            $table=($table[0][0]);

            $num_matches = preg_match_all( '|<td .*?>(.*?)</td>|si', $table, $list );

            $dataTable=[];
            $tmp=[];
            $dataK=0;
            //вырезаемое из парсеной табл.'&mdash;' прочерк, когда цена в ходе торгов не назначена...заменяем на 0 ???
            $cutStrings = ['<td class="right">', '<td class="left">', '</td>', '&nbsp;', '&mdash;'];
            foreach ($list[0] as $key => $value) {
                $tmp[]=$value;
                if($dataK==6){
                    //$dataTable[]=str_replace('&nbsp;', '', $tmp);
                    $dataTable[]=str_replace($cutStrings, ['','','','', 0], $tmp);
                    $tmp=[];
                    $dataK=-1;
                }
                $dataK++;
            }

            // $price ? Рыночная цена (она есть в $dataTable)
            // dd($dataTable);
            return $this->reduceDataTable($instrumentId, $dataTable);
        }

        dd('bad status code');// return [];
    }

    /**
     * Предполагается что прилетает массив вида array[i][j] (i=0...10; j=0...6)
     * И в этом спарсенном массиве оставляем ключи j = 0,1,4 (Дата_торгов, Рын.цена, Объем_тонн)
     * Тут $instrumentId для связи 1 ко многим табл. инсьтрументы->торги (instruments-bidding)
     * @param $instrumentId
     * @param array $dataTable
     * @return mixed
     */
    private function reduceDataTable(int $instrumentId, array $dataTable)
    {
        if(!count($dataTable)) return [];

        $reduceKeys = ['instrument_id', 'trade_at', 'price', 'volume',];
        $result = [];
        foreach ($dataTable as $rows) {

            $reduceData = [];
            $reduceData[] = $instrumentId;
            foreach ($rows as $key => $value) {
                if ($key == 0 ) {
                    $reduceData[] = date_create_from_format('d.m.Y', $value);
                } else if ($key == 1 || $key == 4) {
                    $reduceData[] = $value;
                }
            }

            $result[] = array_combine($reduceKeys, $reduceData);
        }

        return $result;
    }
}
