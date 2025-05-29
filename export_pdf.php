<?php
require_once('tcpdf/tcpdf.php'); // Assicurati di avere la libreria TCPDF

// Connessione
include 'config.php';

$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($order_id <= 0) die("ID ordine non valido.");

$order = $conn->query("SELECT * FROM orders WHERE id = $order_id")->fetch_assoc();
if (!$order) die("Ordine non trovato.");

// Inizializza PDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

$html = "<h1>Ordine #{$order['id']}</h1>";
$html .= "<p>Cliente: {$order['customer_name']}</p>";
$html .= "<p>Data: {$order['order_date']}</p>";
$html .= "<p>Stato: {$order['status']}</p>";

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output("ordine_{$order['id']}.pdf", 'I');
?>