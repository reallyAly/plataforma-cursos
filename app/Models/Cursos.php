<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Cursos';

    protected $primaryKey = 'id_curso';

    public $incrementing = false;

    public $timestamps = false;
}
