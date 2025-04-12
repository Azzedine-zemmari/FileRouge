<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InscriptionService;

class InscriptionController extends Controller
{
    private $inscriptionService;
    public function __construct(InscriptionService $inscriptionService)
    {
        $this->inscriptionService = $inscriptionService;
    }
    public function index(){
        $data = $this->inscriptionService->show();
        dd($data);
        return view('organisateur.Inscription',compact('data'));
    }
}
