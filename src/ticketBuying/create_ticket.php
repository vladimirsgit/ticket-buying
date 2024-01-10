<?php
function createTicket($eventName, $eventDate, $eventLocation, $ticketNumber): string {

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->Image('public/images/ticket_photo.jpg', 10, 153, 190); // Adjust path, x, y, and size

    $pdf->SetDrawColor(100, 100, 100);
    $pdf->Rect(5, 5, 200, 287);
    $pdf->Rect(10, 10, 190, 277);

    $pdf->SetFillColor(100, 149, 237);
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->Cell(0, 20, $eventName, 0, 1, 'C', true);

    $pdf->SetFont('Arial', '', 18);

    $pdf->SetFillColor(220, 220, 220);
    $pdf->Cell(0, 12, $eventDate->format('Y-m-d H:i'), 0, 1, 'L', true);


    $pdf->SetFillColor(144, 238, 144);
    $pdf->Cell(0, 12, $eventLocation, 0, 1, 'L', true);

    $pdf->SetFillColor(255, 218, 185);
    $pdf->Cell(0, 12, 'Ticket Number: ' . $ticketNumber, 0, 1, 'C', true);
    $pdf->Rect(165, 100, 30, 30); //

    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'Organized by X events', 0, 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(0, 5, "Terms & Conditions: Please bring this ticket with you to the event. No refunds or exchanges allowed.", 0, 1);

    return $pdf->Output('S');

}

