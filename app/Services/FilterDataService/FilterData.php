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
        $params = [$fieldName, $fieldValue];
        $this->query->when($params, function ($query, $params) {
            return $query->orderBy('instrument_id', $params[1]);
        });

        return $this->query;
    }

}
