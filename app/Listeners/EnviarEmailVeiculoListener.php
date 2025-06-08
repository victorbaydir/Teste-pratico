<?php 
namespace App\Listeners;

use App\Events\VeiculoSalvoEvent;
use App\Notifications\VeiculoEmailNotification;
use App\User;

class EnviarEmailVeiculoListener
{
    public function handle(VeiculoSalvoEvent $event)
    {
        $objGenerico = $event->proprietario;

        if ($objGenerico && $objGenerico->email) {
            $proprietario = new User();
            $proprietario->email = $objGenerico->email ?? null;
            $proprietario->notify(new VeiculoEmailNotification($event->mensagem));
        }
    }
}
