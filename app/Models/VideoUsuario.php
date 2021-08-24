<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoUsuario extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'VideoUsuario';

    protected $primaryKey = 'id_VideoUsuario';

    public $incrementing = false;

    public $timestamps = false;
}
