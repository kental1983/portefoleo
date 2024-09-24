<?php
// gerar_pdf.php

// Incluir a biblioteca TCPDF
require_once('tcpdf/tcpdf.php');

// Obter os dados enviados via AJAX
$data = json_decode(file_get_contents('php://input'), true);

// Gerar o conteúdo do PDF
$pdf = new TCPDF();

// Configurar o cabeçalho e rodapé
$pdf->SetHeaderData('', 0, 'Europass CV', '');
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// Adicionar uma página
$pdf->AddPage();

// Exemplo de uso dos dados no PDF
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Nome: ' . $data['firstName'] . ' ' . $data['lastName'], 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $data['email'], 0, 1);
$pdf->Cell(0, 10, 'Telefone: ' . $data['phone'], 0, 1);

// Gerar o PDF e obter o conteúdo como uma string
$pdfContent = $pdf->Output('cv.pdf', 'S');

// Definir a resposta como JSON
header('Content-Type: application/json');

// Enviar a resposta para o cliente
echo json_encode(array(
    'success' => true,
    'fileUrl' => 'caminho/para/o/arquivo/gerado/cv.pdf'
));
?>
