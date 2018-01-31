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

        $this->SetXY(90, 40);
        $this->SetFont('Times', 'BI', 10);
        $this->Write(5, 'Statement');

        $this->SetXY(170, 40);
        $this->SetFont('Times', 'BI', 10);
        $this->Write(5, 'Date : ' . date("d/m/Y"));

        /**/
        $this->Line(0, 50, 215, 50);
    }

// Page footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}
