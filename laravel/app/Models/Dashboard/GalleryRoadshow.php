<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class GalleryRoadshow extends Model implements HasMedia
{
    use HasMediaTrait;
    //
     //
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'roadshow_id', 'caption', 'path',
        'filename'
    ];
      /**
     * Define has many relationship.
     *
     * @return object
     */
    public function roadshow()
    {
        return $this->belongsTo(Roadshow::class);
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
        // check if user is superadmin
        // if ( ! is_superadmin()) {
        //     $total_rows = $total_rows
        //         ->where('is_superadmin', 0);
        // }

        if($params['roadshow']!=''){
            $total_rows = $total_rows->where('roadshow_id',$params['roadshow']);
        }
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
     * Count records.
     *
     * @param array $params
     *
     * @return int $total_records total records
     */
    public function countAllRecordsFront($params = [])
    {
        $total_rows = $this;

        $total_rows = $total_rows->count();

        return $total_rows;
    }
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
        // check if user is superadmin
        // if ( ! is_superadmin()) {
        //     $data = $data
        //         ->where('is_superadmin', 0);
        // }
        if($params['roadshow']!=''){
            $data = $data->where('roadshow_id',$params['roadshow']);
        }
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
     * Get all group data.
     *
     * @param array $params
     *
     * @return array|boolean $data
     */
    public function getAllRecordsFront($params = [])
    {
        $data = $this;

        if (isset($params['start']) && isset($params['length'])) {
            $data = $data->skip($params['start'])->take($params['length']);
        }

        $order_field = (isset($params['order_field']) && $params['order_field'] != '') ? $params['order_field'] : $this->getTable(). '.'. $this->getKeyName();
        $order_sort = (isset($params['order_sort']) && $params['order_sort'] != '') ? $params['order_sort'] : config('custom.default.sort_order');

        $data = $data->orderBy($order_field, $order_sort)->get();

        return $data;
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
    public function registerMediaCollections()
    {
        $this->addMediaCollection('iamges-collection')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(350)
                    ->height(350);
                $this->addMediaConversion('normal')
                    ->width(600)
                    ->height(600);
            });
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
