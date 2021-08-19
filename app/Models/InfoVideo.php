<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoVideo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'InfoVideo';

    protected $primaryKey = 'id_video';

    public $incrementing = false;

    public $timestamps = false;
}
