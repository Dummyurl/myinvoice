<?php

ini_set('memory_limit', '1666666M');

class PDF extends FPDF {

// Page header
    function Header() {
        //get nurse information
        global $conn;
        $img_path = base_url() . img_path . "/logo.png";
        $this->SetFont('Helvetica', 'B', 20);
        $this->SetTextColor(0, 0, 0);
        $this->SetAuthor('BOULDER');
        $this->SetTitle('BOULDER');


        $this->SetXY(7, 10);
        $this->Image($img_path, 8, 5, 35);

        $this->SetXY(7, 18);
        $this->SetFontSize(10);
        $this->Cell(50, 3, 'DEALER APPLICATION');

        $this->SetXY(7, 25);
        $this->SetFontSize(10);
        $this->SetFont('Helvetica');
        $this->Cell(50, 3, 'All applicants please complete');

        $this->SetXY(56, 25);
        $this->SetFont('Helvetica', 'U', 10);
        $this->Cell(50, 3, 'Section 1');

        $this->SetXY(72, 25);
        $this->SetFontSize(10);
        $this->SetFont('Helvetica');
        $this->Cell(50, 3, 'and');

        $this->SetXY(80, 25);
        $this->SetFont('Helvetica', 'U', 10);
        $this->Cell(50, 3, 'Section 2');
    }

// Page footer
    function Footer() {
        $valii = 160;

        $this->SetXY(7, $valii + 70);
        $this->SetFontSize(10.5);
        $this->SetFont('Arial');
        $this->Write(5, 'I authorize Boulder Inc to charge the card provided herein for orders placed in connection with the above established ');

        $this->SetXY(7, $valii + 79);
        $this->SetFontSize(11);
        $this->Write(5, 'business at the time of shipment or pick-up.  I agreed to make the required payments for the purchase(s) in ');

        $this->SetXY(7, $valii + 88);
        $this->SetFontSize(11);
        $this->Write(5, 'accordance with the issuing bank cardholder agreement.');

        $this->SetXY(7, $valii + 100);
        $this->SetFontSize(11);
        $this->Write(5, 'CARDHOLDER SIGNATURE:');
        $this->Image(base_url() . uploads_path . '/signature/sign.png', 65, 253, 25);
        $this->Line(60, $valii + 104, 185 - 50, $valii + 104);

        $this->SetXY(134, $valii + 100);
        $this->SetFontSize(11);
        $this->Write(5, ' DATE:');
        $this->SetXY(147, $valii + 100);
        $this->Write(5, date('Y-m-d'));
        $this->Line(148, $valii + 104, 250 - 50, $valii + 104);
    }

}

?>