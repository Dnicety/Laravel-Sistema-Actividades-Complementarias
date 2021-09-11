<?php

namespace App\Http\Controllers;
use App\Mail\ConstanciaMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(Request $request){
        Mail::to($request->mail)->send(new ConstanciaMail($request->idCredito));
        return back()->withSuccess('Correo enviado exitosamente!');
    }
}
