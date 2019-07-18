<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Email
 * @package App
 */
class Email extends Model
{
    protected $fillable = ['email', 'link_id'];

    /**
    * Get the link that owns the email.
    */
    public function post()
    {
        return $this->belongsTo('App\Link');
    }
}
