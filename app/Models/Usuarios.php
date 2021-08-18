<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Usuario';

    protected $primaryKey = 'id_usuario';

    public $incrementing = false;

    public $timestamps = false;

}
