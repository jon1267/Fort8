<?php
namespace App\Services\FilterDataService;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class FilterData
 * Класс для фильтрации данных. Возаращает экземпляр Builder $query c наложенными ограничениями
 * 1)Для фильтрации по дате предполагаю что в Request есть поля 'date_from' & 'date_to'
 * @package App\Services\FilterDataService
 */
class FilterData
{
    private $query;
    private $request;

    public function __construct($tableName, $request)
    {
        $this->query = DB::table($tableName);
        $this->request = $request;
    }

    public static function init(string $tableName, $request) {
        return new self($tableName, $request);
    }

    /**
     * Пока предполагаю что в реквесте есть поля с именами 'date_from' 'date_to'
     * а выборка диапазона дат идет по полю таблицы 'trade_at'
     * @param string
     * @return $this
     */
    public function dateRangeFilter(string $fieldName = 'trade_at' )
    {
        $r = $this->request;
        $r['field_name'] = $fieldName;
        if (($r['date_from'] !== null) && ($r['date_to'] !== null)) {
            $this->query->when($r, function ($query, $r) {
                return $query->whereBetween($r['field_name'], [$r['date_from'], $r['date_to']]);
            });
        } elseif (($r['date_from'] !== null) && ($r['date_to'] === null)) {
            $this->query->when($r, function ($query, $r) {
                return $this->query->whereDate($r['field_name'], '>=', $r['date_from']);
            });
        } elseif (($r['date_from'] === null) && ($r['date_to'] !== null)) {
            $this->query->when($r, function ($query, $r) {
                return $this->query->whereDate($r['field_name'], '<=', $r['date_to']);
            });
        }

        return $this;
    }

    /**
     * Это добавка к квери билдеру типа $query->where('field', $value)
     * @param null $fieldName
     * @param null $fieldValue
     * @return $this
     */
    public function fieldFilter($fieldName = null, $fieldValue = null)
    {
        if (is_null($fieldName) || is_null($fieldValue)) return $this;

        $params = [$fieldName, $fieldValue];
        $this->query->when($params, function ($query, $params) {
            return $query->where($params[0], $params[1]);
        });

        return $this;
    }

    public function multiSelectFilter(string $fieldName = null, array $values = [])
    {
        if (is_null($fieldName) || !count($values)) return $this;

        $params = [$fieldName, $values];
        $this->query->when($params, function ($query, $params) {
            return $query->whereIn($params[0], $params[1]);
        });

        return $this;
    }

    public function orderFilter($fieldName, $fieldValue)
    {
        //была проблема: отсортировать по 2-ум полям, если второе поле дата и еще DESC.
        //кидается  SQLSTATE[HY000]: General error: 3065 Expression #2 of ORDER BY clause is not in SELECT list,
        //references column 'fort8.bidding.trade_at' which is not in SELECT list; this is incompatible with DISTINCT
        //ну естеств incompatible with DISTINCT сует ларин билдер... без него в мускуле и ПМА все идет!  :(
        //нашел! :) проблемы нет. вместо $query->select('instrument_id')->distinct()->get(); к-рое перегадило $query
        //сделал $instruments->unique('instrument_id');

        /*if (preg_match('/\,/', $fieldName)) {
            $fields = explode(',', $fieldName);
            $fieldName = array_values($fields);
        }*/

        $params = [$fieldName, $fieldValue];
        $this->query->when($params, function ($query, $params) {
            // тут как-бы жестко вшит 'instrument_id' это нужно в этой задаче, но м.б. убрать потом...
            return $query->orderBy('instrument_id')->orderBy($params[0], $params[1]);
        });

        return $this->query;
    }

/*
    SELECT * FROM `bidding`
    WHERE trade_at BETWEEN '2020-11-01' AND '2020-11-18'
    AND `instrument_id` = 1 OR `instrument_id` = 2
    ORDER BY `instrument_id`, `trade_at` DESC;

    SELECT * FROM `bidding`
    WHERE trade_at BETWEEN '2020-10-01' AND '2020-11-18'
    AND `instrument_id` IN (6,7)
    ORDER BY `instrument_id` ASC, `trade_at` DESC;
*/

}
