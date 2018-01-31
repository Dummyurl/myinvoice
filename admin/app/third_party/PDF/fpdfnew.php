<?php

ini_set('memory_limit', '1666666M');

include APPPATH . 'third_party/PDF/fpdf.php';

class PDF extends FPDF {

// Page header
    function Header() {
        $this->CI = & get_instance();
        $yval = 5;
        //get nurse information
        global $conn;
        $CompanyName = "";
        $OwnerName = "";
        $NursePhone = "";
        $PinCode = "";
        $GSTNo = "";
        $CompanyPhone = "";
        $CompanyMobile = "";
        $Address = "";
        $City = "";


        $strsqln = "SELECT * FROM tbl_setting WHERE ID=1";
        $qry_1 = $this->CI->db->query($strsqln);
        $resultn = $qry_1->result_array();
        if (count($resultn) > 0) {
            foreach ($resultn as $row) {
                $CompanyName = $row['CompanyName'];
                $OwnerName = $row['OwnerName'];
                $CompanyPhone = $row['CompanyPhone'];
                $CompanyMobile = preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "($1)-$2-$3", $row['CompanyMobile']);
                $Address = $row['Address'];
                $City = $row['City'];
                $PinCode = $row['PinCode'];
                $GSTNo = $row['GSTNo'];
            }
        }


        $strsql11 = "SELECT ID+1 as NextId FROM tbl_invoice WHERE 1 ORDER BY ID DESC LIMIT 1";
        $qry_one = $this->CI->db->query($strsql11);
        $result11 = $qry_one->row_array();

        $invoice_no = 0;
        if (count($result11['NextId']) > 0) {
            $invoice_no = $result11['NextId'];
        }
        if ($invoice_no == 0) {
            $invoice_no = 1;
        }

        $CustomerName = $this->CI->input->post('CustomerName') ? $this->CI->input->post('CustomerName') : "";
        $CustomerGSTNo = $this->CI->input->post('CustomerGSTNo') ? $this->CI->input->post('CustomerGSTNo') : "";
        $PlaceOfSuppy = $this->CI->input->post('PlaceOfSuppy') ? $this->CI->input->post('PlaceOfSuppy') : "";
        $CustomerAddress = $this->CI->input->post('CustomerAddress') ? $this->CI->input->post('CustomerAddress') : "";
        $CustomerPhone = $this->CI->input->post('CustomerPhone') ? $this->CI->input->post('CustomerPhone') : "";
        $total_gst = $this->CI->input->post('total_gst') ? $this->CI->input->post('total_gst') : "";
        $total_cgst = $this->CI->input->post('total_cgst') ? $this->CI->input->post('total_cgst') : "";
        $total_sgst = $this->CI->input->post('total_sgst') ? $this->CI->input->post('total_sgst') : "";

        $this->SetFont('Helvetica', '', 20);

        //$this->SetTextColor(50, 60, 100);
        //Set header information
        $this->SetAuthor($CompanyName);
        $this->SetTitle($CompanyName);
        //set font for the entire document

        $this->SetXY(15, 10);
        $this->Cell(0, 10, $CompanyName, 0, 0, 'C', 0);

        //Set x and y position for the main text, reduce font size and write content
        $this->SetXY(7, 17);
        $this->SetFontSize(9);
        $this->Cell(0, 10, "Address : " . $Address, 0, 0, 'C', 0);

        $this->SetXY(7, 21);
        $this->SetFontSize(8);
        $this->Cell(0, 10, "Phone: " . $CompanyPhone, 0, 0, 'C', 0);

        $this->SetXY(7, 25);
        $this->SetFontSize(8);
        $this->Cell(0, 10, "GSTIN No.: " . $GSTNo, 0, 0, 'C', 0);

        /* DRAR LINE */
        $this->SetXY(10, 40);
        $this->SetFont('Times', 'BI', 10);
        $this->Write(5, 'Debit Memo');

        $this->SetXY(90, 40);
        $this->SetFont('Times', 'BI', 10);
        $this->Write(5, 'TAX INVOICE');

        $this->SetXY(180, 40);
        $this->Write(5, 'Original');

        /**/
        $this->Line(0, 45, 215, 45);

        $this->SetXY(10, 50);
        $this->Write(5, 'M/s.: ' . ucwords($CustomerName));

        $this->SetXY(10, 55);
        $this->Write(5, 'Address: ' . $CustomerAddress);

        $this->SetXY(10, 60);
        $this->Write(5, 'GSTIN No.: ' . $CustomerGSTNo);

        $this->SetXY(10, 65);
        $this->Write(5, 'Place Of Supply ' . $PlaceOfSuppy);

        $this->SetXY(160, 50);
        $this->Write(5, 'Invoice No.: GT/' . str_pad($invoice_no, 3, 0, STR_PAD_LEFT));

        $this->SetXY(160, 55);
        $this->Write(5, 'Date       : ' . date("d/m/Y"));

        $this->SetXY(160, 60);
        $this->Write(5, 'Time       : ' . date("h:i A"));

        $this->Line(10, 80, 200, 80);
    }

// Page footer
    function Footer() {
        $valii = 180;
        $this->SetFontSize(8);
        $this->Line(0, $valii + 50, 215, $valii + 50);

        $this->SetXY(150, $valii + 51);
        $this->Write(5, 'Sub Total          ' . number_format($this->netTotal, 2));

        $this->SetXY(150, $valii + 55);
        $this->Write(5, 'Round Off          ' . number_format($this->RoundOff, 2));

        $this->SetXY(150, $valii + 65);
        $this->Write(5, 'Grand Total    ' . number_format($this->grandTotal, 2));
        $this->Line(200, $valii + 63, 189 - 50, $valii + 63);

        $this->SetXY(10, $valii + 65);
        $this->Write(5, 'Notes:');

        $this->SetXY(10, $valii + 70);
        $this->SetFontSize(9);
        $this->Write(3, 'Terms & Condition');

        $this->SetXY(10, $valii + 75);

        $this->Write(3, '1) Goods Once Sold Will Not Be Accepted.');


        $this->SetXY(10, $valii + 90);
        $this->SetFontSize(12);
        $this->Write(3, 'Signature:');
        $this->Line(30, $valii + 93, 170 - 50, $valii + 93);

        $this->SetXY(126, $valii + 90);
        $this->SetFontSize(13);
        $this->Write(3, 'Date:');
        $this->Line(189, $valii + 93, 189 - 50, $valii + 93);

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}
