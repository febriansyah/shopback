<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
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
}
