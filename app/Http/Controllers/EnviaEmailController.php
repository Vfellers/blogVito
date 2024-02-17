<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EnviaEmailController extends Controller
{
    public function index(){
        $result = Mail::to("victor.fellers@gmail.com")->send(new SendMail("mensagem de teste", "Victor"));

        return ($result) ? "E-mail enviado" : "erro";
    }
}
