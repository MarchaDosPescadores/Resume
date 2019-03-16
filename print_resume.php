<?php

use Dompdf\Dompdf;
use Dompdf\Options;
require_once 'dompdf/autoload.inc.php';
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);


$html = file_get_contents("https://www.arkadydemin.com/resume/index_resume.php");


$dompdf->load_html($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();
$dompdf->view = "Fith";
$dompdf->statusbar = 0;
#$dompdf->messages = 0;

//Output the generated PDF to Browser
$dompdf->stream("print_test.pdf", array("Attachment" => 0));
 

function delete_all_between($beginning, $end, $string) {
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if ($beginningPos === false || $endPos === false) {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  return str_replace($textToDelete, '', $string);
}


?>
