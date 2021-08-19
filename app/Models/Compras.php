<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Compra';

    protected $primaryKey = 'id_compra';

    public $incrementing = false;

    public $timestamps = false;
}
