<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificados extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Certificado';

    protected $primaryKey = 'id_certificado';

    public $incrementing = false;

    public $timestamps = false;
}
