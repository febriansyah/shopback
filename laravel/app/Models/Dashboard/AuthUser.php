<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\User\ResetPasswordNotification;

use Hash;
use DB;

class AuthUser extends Model  implements AuthenticatableContract,CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable;
    //
     /**
     * Implement soft delete method.
     *
     */

    protected $table = 'member';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'password',
        'email',  'phone', 'user_status','photo', 'remember_token', 'last_login_at'
    ];


    /**
     * The attributes excluded from the model's form.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];


      /**
     * Set default cast for password field.
     *
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }
     /**
     * Send resetp password notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string|null
     */
    public function getRememberToken()
    {
        if (!empty($this->getRememberTokenName())) {
            return (string)$this->{$this->getRememberTokenName()};
        }
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        if (!empty($this->getRememberTokenName())) {
            $this->{$this->getRememberTokenName()} = $value;
        }
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

     /**
     * Get Member Info by email.
     *
     * @param  string $email
     *
     * @return array|boolean $member_data
     */
    public function getInfoByEmail($email)
    {
        $member_data = $this
            ->whereRaw("LCASE(email) = '" . strtolower($email) . "'")
            ->first();

        if ($member_data) {
            // return info auth member
            return $member_data;
        }

        return false;
    }
	/**
     * Get Member Info by username.
     *
     * @param  string $username
     *
     * @return array|boolean $member_data
     */
    public function getInfoByUsername($username)
    {
        $member_data = $this
            ->whereRaw("LCASE(username) = '" . strtolower($username) . "'")
            ->first();

        if ($member_data) {
            // return info auth member
            return $member_data;
        }

        return false;
    }
    /**
     * Define belongs to relationship.
     *
     * @return object
     */
    public function user_group()
    {
        return $this->belongsTo('App\Models\Dashboard\UserGroup');
    }
      /**
     * Define has many relationship.
     *
     * @return object
     */
    public function user_menu_group()
    {

        return $this->belongsTo('App\Models\Dashboard\UserMenuGroup');

    }
     /**
     * Count all records.
     *
     * @param array $params
     *
     * @return integer $total_records total records
     */
    public function countAllRecords($params = [])
    {
    	$total_rows = $this
            ->leftJoin(DB::raw("(
                    SELECT id, name as group_name
                    from {$this->getConnection()->getTablePrefix()}{$this->user_group()->getModel()->getTable()}
                ) as {$this->getConnection()->getTablePrefix()}{$this->user_group()->getModel()->getTable()}
                "),
                $this->user_group()->getQualifiedOwnerKeyName(), '=', $this->user_group()->getQualifiedForeignKeyName()
            );



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
     * Get all data.
     *
     * @param array $params
     *
     * @return array|boolean $data
     */
    public function getAllRecords($params = [])
    {
        $data = $this
            ->select([
                $this->getTable(). '.*',
                $this->user_group()->getModel()->getTable(). '.group_name'
            ])
            ->leftJoin(DB::raw("(
                    SELECT id, name as group_name
                    from {$this->getConnection()->getTablePrefix()}{$this->user_group()->getModel()->getTable()}
                ) as {$this->getConnection()->getTablePrefix()}{$this->user_group()->getModel()->getTable()}
                "),
                $this->user_group()->getQualifiedOwnerKeyName(), '=', $this->user_group()->getQualifiedForeignKeyName()
            );

        // check if user is superadmin


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
     * Get Model data by ID.
     *
     * @param  mixed $id
     *
     * @return array|boolean $data
     */
    public function getModelById($id)
    {
        $data = $this->with(['user_group']);
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
