<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Boolean;

class Veiculo extends Model
{
    use SoftDeletes;
    protected $table="veiculos";
    protected $dates = ['deleted_at'];
    protected $fillable=[
        'id',
        'placa',
        'renavam',
        'modelo',
        'marca',
        'ano',
        'proprietario'
    ];

    public function validate() {
        
    }
}
