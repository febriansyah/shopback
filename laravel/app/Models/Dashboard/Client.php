<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    //
    protected $table ="client";
    //
     //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name','status'
    ];


    /**
     * Get all group data.
     *
     * @param array $params
     *
     * @return array|boolean $data
     */
    public function getAllRecords($params = [])
    {
        $data = $this;
        if (isset($params['search_value']) && $params['search_value'] != '') {
            $data = $data->where(function($query) use($params) {
                $i = 0;
                foreach ($params['search_field'] as $row => $val) {
                    if ($val['searchable'] == 'true') {
                        if ($i == 0) {
                            $query->whereRaw("LCASE({$val['data']}) like '%" .strtolower($params['search_value']). "%'");
                        } else {
                            $query->orwhereRaw("LCASE({$val['data']}) like '%" .strtolower($params['search_value']). "%'");
                        }
                        $i++;
                    }
                }
            });
        }

        if (isset($params['start']) && isset($params['length'])) {
            $data = $data->skip($params['start'])->take($params['length']);
        }

        $order_field = (isset($params['order_field']) && $params['order_field'] != '') ? $params['order_field'] : $this->getTable(). '.'. $this->getKeyName();
        $order_sort = (isset($params['order_sort']) && $params['order_sort'] != '') ? $params['order_sort'] : config('custom.default.sort_order');

        $data = $data->orderBy($order_field, $order_sort)->get();

        return $data;
    }
    /**
     * Count records.
     *
     * @param array $params
     *
     * @return int $total_records total records
     */
    public function countAllRecords($params = [])
    {
        $total_rows = $this;


        if (isset($params['search_value']) && $params['search_value'] != '') {
            $total_rows = $total_rows->where(function($query) use($params) {
                $i = 0;
                foreach ($params['search_field'] as $row => $val) {
                    if ($val['searchable'] == 'true') {
                        if ($i == 0) {
                            $query->whereRaw("LCASE({$val['data']}) like '%" .strtolower($params['search_value']). "%'");
                        } else {
                            $query->orwhereRaw("LCASE({$val['data']}) like '%" .strtolower($params['search_value']). "%'");
                        }
                        $i++;
                    }
                }
            });
        }

        $total_rows = $total_rows->count();

        return $total_rows;
    }
     /**
     * Get Model data by ID.
     *
     * @param  mixed $id
     *
     * @return array|boolean $data
     */
    public function getModelById($id)
    {
        $data = $this;
        if (is_array($id)) {
            return $data->whereIn($this->getKeyName(), $id)->get();
        }

        return $data->where($this->getKeyName(), $id)->first();
    }
     /**
     * Delete record(s) from this model.
     *
     * @param  int|array $id
     */
    public function deleteModelById($id)
    {
        if (is_array($id)) {
            $this->whereIn($this->getKeyName(), $id)->delete();
        } else {
            $this->where($this->getKeyName(), $id)->delete();
        }
    }
}
