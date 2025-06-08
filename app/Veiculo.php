<?php

namespace App;

use App\Mail\CreateVeiculoMail;
use App\Mail\UpdateVeiculoMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Mail;

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

    public static function validate (Request $request) {
        $validator = self::rules($request);
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }
    }

    public static function rules(Request $request) {
            return Validator::make($request->all(), [
            'placa' => ['required', 'regex:/^[A-Z]{3}[0-9]{4}$/'],
            'ano' => ['required', 'digits:4', 'integer'],
        ], [
            'placa.required' => 'O campo PLACA é obrigatório.',
            'placa.regex' => 'A placa deve ter o formato AAA1111.',
            'ano.required' => 'O campo ANO é obrigatório.',
            'ano.digits' => 'O campo ANO deve ter o formato 1111.',
            'ano.integer' => 'O campo ANO suporta somente números.',
        ]);
    }

}
