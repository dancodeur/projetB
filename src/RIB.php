<?php

use Dompdf\Dompdf;
require_once 'incl/dompdf/autoload.inc.php';
// instantiate and use the dompdf class
$dompdf = new Dompdf();

ob_start();
require("incl/pdf_rib.php");
$html=ob_get_contents();
ob_end_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('RIB.php',['Attachment'=>false]);