<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Link
 * @package App
 */
class Link extends Model
{
    protected $fillable = ['link', 'parent_id'];

    /**
     * Get the emails for the link.
     */
    public function emails()
    {
        return $this->hasMany('App\Email');
    }

    /**
     * Get the parent for the link
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentLink()
    {
        return $this->hasOne('App\Link', 'parent_id');
    }
}
