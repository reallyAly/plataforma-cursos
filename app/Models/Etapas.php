<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Etapa';

    protected $primaryKey = 'id_etapa';

    public $incrementing = false;

    public $timestamps = false;
}
