<?php
namespace App\Events;

use App\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VeiculoSalvoEvent
{
    use Dispatchable, SerializesModels;
    public $mensagem;
    public $proprietario;

    public function __construct($proprietario, $mensagem)
    {
        $this->proprietario = $proprietario;
        $this->mensagem = $mensagem;
    }
}
