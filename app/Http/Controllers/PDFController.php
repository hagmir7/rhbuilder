<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Response;

class PDFController extends Controller
{

    public function editAndPrintPDF()
    {
        $pdfPath = public_path('documents/fiche-entretien-d-embauche.pdf'); // Your original file
        $outputPath = storage_path('app/public/updated.pdf');

        $pdf = new Fpdi();

        // Import first page of existing PDF
        $pageCount = $pdf->setSourceFile($pdfPath);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $tplId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($tplId);

            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($tplId);

            // Add custom content on top of the existing page
            $pdf->SetFont('Helvetica', 'B', 19);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->Text(355, 18, now()->format('d-m-Y')); // x, y, text
            $pdf->Text(355, 32, 'IC-EE-01');
            $pdf->Text(362, 44, 'V1.1');
        }

        $pdf->Output($outputPath, 'F');

        // Send file to browser for printing
        return Response::file($outputPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="updated.pdf"',
        ]);
    }
}
