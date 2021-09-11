<?php

namespace App\Mail;
use App\Models\Actividad;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;
use PDF;

class ConstanciaMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $idCredito;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idCredito)
    {
        $this->idCredito = $idCredito;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $credito = DB::select('SELECT docFirmado, act.nombre FROM creditos 
        JOIN actividads AS act ON creditos.idAct = act.idAct WHERE idCredito = ?', [$this->idCredito]);
        $public_path = public_path();
        $url = $public_path.$credito[0]->docFirmado;
        $jefedepto = DB::select('SELECT * FROM users WHERE tipo = ? AND departamento = ?', ['JEFEDEPTO', Auth::user()->departamento]);
        return $this->subject('Constancia de actividades complementarias: ' . $credito[0]->nombre)->view('emails.constanciaMail', compact('jefedepto'))->attach($url, ['as' => 'constancia.jpg', 'mime' => 'image/jpeg']);
    }
}
