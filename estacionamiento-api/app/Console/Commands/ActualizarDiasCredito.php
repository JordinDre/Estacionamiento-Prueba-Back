<?php

namespace App\Console\Commands;

use App\Models\Orden;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;

class ActualizarDiasCredito extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:actualizar-dias-credito';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el campo dias_credito de los usuarios';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ordenes = Orden::where('estado_id', '>=', 5)->where('tipo_pago_id', 2)->get();

        foreach ($ordenes as $orden) {
            $orden->dias_credito -= 1;
            $orden->save();
        }

        $this->info('Los días de crédito de los clientes han sido actualizados');
    }
}
