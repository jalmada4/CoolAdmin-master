<?php 
require_once '../../assets/plugins/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

ob_start();
include 'print_view.php';
$content = ob_get_clean();
$nombrearchivo = "report_nota_remision.pdf";

// Configurar Html2Pdf para orientación horizontal (landscape)
$html2pdf = new Html2Pdf('L', 'A4', 'es'); // 'L' para Landscape, 'P' es Portrait
$html2pdf->writeHTML($content);
$html2pdf->output($nombrearchivo);
?>
