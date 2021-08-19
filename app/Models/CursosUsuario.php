<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursosUsuario extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'CursoUsuario';

    protected $primaryKey = 'id_cursoUsuario';

    public $incrementing = false;

    public $timestamps = false;
}
