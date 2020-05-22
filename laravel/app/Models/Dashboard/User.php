<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\User\ResetPasswordNotification;

class User extends Model implements AuthenticatableContract,CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable;
    //
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
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
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
     * Define belongs to many relationship.
     *
     * @return object
     */
    public function Karya()
    {
        return $this->hasMany(Karya::class);
    }
    /**
     * Get Member Info by id.
     *
     * @param  string $id
     *
     * @return array|boolean $member_data
     */
    public function getInfoById($id)
    {
        $member_data = $this
            ->whereRaw("id = '" .$id. "'")
            ->first();

        if ($member_data) {
            // return info auth member
            return $member_data;
        }

        return false;
    }


     /**
     * Get Member Info by id.
     *
     * @param  string $id
     *
     * @return array|boolean $member_data
     */
    public function getInfoByEmail($email)
    {
        $member_data = $this
            ->whereRaw("email = '" .$email. "'")
            ->first();

        if ($member_data) {
            // return info auth member
            return $member_data;
        }

        return false;
    }
}
