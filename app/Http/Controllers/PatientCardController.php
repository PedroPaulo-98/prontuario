<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;

class PatientCardController extends Controller
{
    public function generate(Patient $patient)
    {
        $pdf = PDF::loadView('pdf/patient_card', compact('patient'));
        
        return $pdf->download("ficha-paciente-{$patient->id}.pdf");
        
        // Ou para visualizar no navegador:
        // return $pdf->stream("ficha-paciente-{$patient->id}.pdf");
    }
}