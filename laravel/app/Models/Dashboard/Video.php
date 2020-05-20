<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $table ="videos";
    //
     //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'title','description','brand','path', 'video', 'photo','target_view',
         'background','start_publish','end_publish','status','client_id','video_name'
    ];

    /**
     * Get relation with same table as a parent.
     *
     * @return object
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
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
        $data = $this->with('client');
        if (isset($params['search']) && $params['search'] != '') {
            $data = $data->where(function($query) use($params) {

                $query->whereRaw("LCASE(title) like '%" .strtolower($params['search']). "%'");
                $query->orwhereRaw("LCASE(brand) like '%" .strtolower($params['search']). "%'");

            });
        }

        if (isset($params['start']) && isset($params['length'])) {
            $data = $data->skip($params['start'])->take($params['length']);
        }


        $data = $data->where('status','1')->orderBy('id',$params['sort'] )->get();

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


        if (isset($params['search']) && $params['search'] != '') {
            $total_rows = $total_rows->where(function($query) use($params) {

                $query->whereRaw("LCASE(title) like '%" .strtolower($params['search']). "%'");
                $query->orwhereRaw("LCASE(brand) like '%" .strtolower($params['search']). "%'");

            });
        }


        $total_rows = $total_rows->where('status','1')->count();

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
        $data = $this->with('roadshow');
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
