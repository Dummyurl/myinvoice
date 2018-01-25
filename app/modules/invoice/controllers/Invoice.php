<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $res = $this->authenticate->check_login();
        if (!$res) {
            redirect('login');
        }
        $this->load->model('model_invoice');
        $this->load->model('content/model_support');
        $this->load->library('general');
    }

    public function index() {
        $invoice_data = $this->model_invoice->getData("", "*");
        $data['invoice_data'] = $invoice_data;
        $data['title'] = "Manage Invoice";
        $this->load->view("invoice_manage", $data);
    }

    public function cleandashspace($string) {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/-/', '', $string);
    }

    public function add_invoice() {
        $customer_data = $this->model_invoice->getData("customer", "*");
        $data['title'] = "Add invoice";
        $data['customer_data'] = $customer_data;
        $this->load->view("add_invoice", $data);
    }

    public function add_invoice_action() {
        $invoice_name = $this->GeneratePDF("E");
        if ($invoice_name != "") {
            //Customer details
            $CustomerName = $this->input->post('CustomerName');
            $CustomerGSTNo = $this->input->post('CustomerGSTNo');
            $PlaceOfSuppy = $this->input->post('PlaceOfSuppy');
            $CustomerAddress = $this->input->post('CustomerAddress');
            $CustomerPhone = $this->input->post('CustomerPhone');
            $total_gst = $this->input->post('total_gst');
            $total_cgst = $this->input->post('total_cgst');
            $total_sgst = $this->input->post('total_sgst');
            $Customer = $this->input->post('Customer');

            $invoice_data['CustomerID'] = $Customer;
            $invoice_data['CustomerName'] = $CustomerName;
            $invoice_data['CustomerPhone'] = $CustomerPhone;
            $invoice_data['CustomerAddress'] = $CustomerAddress;
            $invoice_data['CustomerGSTNo'] = $CustomerGSTNo;
            $invoice_data['PlaceOfSuppy'] = $PlaceOfSuppy;
            $invoice_data['NetAmount'] = 0;
            $invoice_data['GST'] = $total_gst;
            $invoice_data['CreatedOn'] = date("Y-m-d H:i:s");
            $invoice_data['invoice_name'] = $invoice_name;

            //Product details
            $ProductName_arr = $this->input->post('ProductName');
            $ProductQty_arr = $this->input->post('ProductQty');
            $ProductRate_arr = $this->input->post('ProductRate');

            $id = $this->model_invoice->insert('', $invoice_data);
            if ($id) {
                $spdata = array();
                $invoice_net_amount = 0;
                foreach ($ProductName_arr as $key => $val) {
                    $price = ($ProductQty_arr[$key] * $ProductRate_arr[$key]);
                    $product_sgst = (($price) * ($total_sgst / 100));
                    $product_cgst = (($price) * ($total_cgst / 100));

                    $NetAmount = ($price + $product_sgst + $product_cgst);
                    $invoice_net_amount = $invoice_net_amount + $NetAmount;
                    $spdata[] = array(
                        'Invoice_ID' => $id,
                        'ProductName' => $ProductName_arr[$key],
                        'ProductQty' => $ProductQty_arr[$key],
                        'ProductRate' => $ProductRate_arr[$key],
                        'ProductAmount' => $price,
                        'Gst' => $total_gst,
                        'Cgst' => $product_cgst,
                        'Sgst' => $product_sgst,
                        'NetAmount' => $NetAmount,
                        'CreatedOn' => date("Y-m-d H:i:s"),
                    );
                }
                $res = $this->model_invoice->insert_mul('tbl_invoice_product', $spdata);
                $updata['NetAmount'] = $invoice_net_amount;
                $updata['UpdatedOn'] = date("Y-m-d H:i:s");
                $res = $this->model_invoice->update('', $updata, "ID=" . $id);

                if ($res) {
                    echo true;
                } else {
                    echo "error";
                }
                $this->session->set_flashdata('success', 'Invoice has been generated successfully.');
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }

    public function GeneratePDF($flag) {
        $CustomerName = $this->input->post('CustomerName');
        $CustomerGSTNo = $this->input->post('CustomerGSTNo');
        $PlaceOfSuppy = $this->input->post('PlaceOfSuppy');
        $CustomerAddress = $this->input->post('CustomerAddress');
        $CustomerPhone = $this->input->post('CustomerPhone');
        $total_gst = $this->input->post('total_gst');
        $total_cgst = $this->input->post('total_cgst');
        $total_sgst = $this->input->post('total_sgst');

        include APPPATH . 'third_party/PDF/fpdfnew.php';

        //create a FPDF object
        $pdf = new PDF();
        $j = 0;
        global $conn;

        //Get order Count
        $strsql11 = "SELECT ID+1 as NextId FROM tbl_invoice WHERE 1 ORDER BY ID DESC LIMIT 1";
        $qry_one = $this->db->query($strsql11);
        $result11 = $qry_one->row_array();

        $invoice_no = 0;
        if (count($result11['NextId']) > 0) {
            $invoice_no = $result11['NextId'];
        }
        if ($invoice_no == 0) {
            $invoice_no = 1;
        }
        $pdf->AliasNbPages();
        $pdf->AddPage();


        $pdf->SetXY(5, 81);
        $pdf->Write(10, 'Product Details');

        $pdf->SetXY(5, 90);
        $pdf->Cell(10, 10, 'SrNo.', 1, 0, 'C');

        $pdf->SetXY(15, 90);
        $pdf->Cell(70, 10, 'Product Name', 1, 0, 'C');

//        $pdf->SetXY(65, 90);
//        $pdf->Cell(20, 10, 'Size', 1, 0, 'C');
//
//        $pdf->SetXY(85, 90);
//        $pdf->Cell(20, 10, 'HSN', 1, 0, 'C');

        $pdf->SetXY(85, 90);
        $pdf->Cell(20, 10, 'Qty', 1, 0, 'C');

        $pdf->SetXY(105, 90);
        $pdf->Cell(20, 10, 'Rate', 1, 0, 'C');

        $pdf->SetXY(125, 90);
        $pdf->Cell(20, 10, 'Amount', 1, 0, 'C');

        $pdf->SetXY(145, 90);
        $pdf->Cell(15, 10, 'GST(%)', 1, 0, 'L');

        $pdf->SetXY(160, 90);
        $pdf->Cell(12, 10, 'CGST', 1, 0, 'L');

        $pdf->SetXY(172, 90);
        $pdf->Cell(12, 10, 'SGST', 1, 0, 'L');

        $pdf->SetXY(184, 90);
        $pdf->Cell(20, 10, 'Net Amount', 1, 0, 'L');

        $yval = 10;
        //Product details
        $ProductName_arr = $this->input->post('ProductName');
        $ProductQty_arr = $this->input->post('ProductQty');
        $ProductRate_arr = $this->input->post('ProductRate');

        $spdata = array();
        $invoice_net_amount = 0;
        $srno = 1;
        foreach ($ProductName_arr as $key => $val) {
            $price = ($ProductQty_arr[$key] * $ProductRate_arr[$key]);
            $product_sgst = (($price) * ($total_sgst / 100));
            $product_cgst = (($price) * ($total_cgst / 100));

            $NetAmount = ($price + $product_sgst + $product_cgst);
            $invoice_net_amount = $invoice_net_amount + $NetAmount;

            $pdf->SetXY(5, 90 + $yval);
            $pdf->SetFontSize(7);
            $pdf->Cell(10, 10, $srno, 1, 0, 'C');

            $pdf->SetXY(15, 90 + $yval);
            $pdf->SetFontSize(7);
            $pdf->Cell(70, 10, $ProductName_arr[$key], 1, 0, 'C');

//            $pdf->SetXY(65, 90 + $yval);
//            $pdf->SetFontSize(7);
//            $pdf->Cell(20, 10, $ProductSize_arr[$key], 1, 0, 'C');
//
//            $pdf->SetXY(85, 90 + $yval);
//            $pdf->SetFontSize(7);
//            $pdf->Cell(20, 10, $ProductHSN_arr[$key], 1, 0, 'C');

            $pdf->SetXY(85, 90 + $yval);
            $pdf->SetFontSize(7);
            $pdf->Cell(20, 10, $ProductQty_arr[$key], 1, 0, 'C');

            $pdf->SetXY(105, 90 + $yval);
            $pdf->SetFontSize(7);
            $pdf->Cell(20, 10, number_format($ProductRate_arr[$key], 2), 1, 0, 'C');

            $pdf->SetXY(125, 90 + $yval);
            $pdf->SetFontSize(7);
            $pdf->Cell(20, 10, number_format($price, 2), 1, 0, 'C');

            $pdf->SetXY(145, 90 + $yval);
            $pdf->SetFontSize(7);
            $pdf->Cell(15, 10, $total_gst, 1, 0, 'L');

            $pdf->SetXY(160, 90 + $yval);
            $pdf->SetFontSize(7);
            $pdf->Cell(12, 10, number_format($product_cgst, 2), 1, 0, 'L');

            $pdf->SetXY(172, 90 + $yval);
            $pdf->SetFontSize(7);
            $pdf->Cell(12, 10, number_format($product_sgst, 2), 1, 0, 'L');

            $pdf->SetXY(184, 90 + $yval);
            $pdf->SetFontSize(7);
            $pdf->Cell(20, 10, number_format($NetAmount, 2), 1, 0, 'L');
            $yval = $yval + 10;
            $srno++;
        }

        //calculate round of 

        $rounf_off = round($invoice_net_amount, 0, PHP_ROUND_HALF_EVEN);
        $rval = $rounf_off - $invoice_net_amount;


        $pdf->netTotal = $invoice_net_amount;
        $pdf->RoundOff = $rval;
        $pdf->grandTotal = $rounf_off;

        if ($flag == "E") {
            $filename = 'invoice_' . $invoice_no . '.pdf';
            $pdf->Output(INVOICE_PDF . $filename, 'F');
            chmod(INVOICE_PDF . $filename, 0777);
            return $filename;
        } else {
            $pdf->Output('invoice_' . $invoice_no . '.pdf', $flag);
        }
    }

    public function send_invoice() {
        $Email = $this->input->post('Email');
        $Subject = $this->input->post('Subject');
        $Name = $this->input->post('Name');
        $Message = $this->input->post('Message');
        $url = $this->input->post('invoice_url');

        $define_param['to_name'] = $Name;
        $define_param['to_email'] = $Email;


        $html = '<tr>';
        $html .= '<td align="center"><h3 style="font-family: HelveticaNeue-Bold;font-size: 20px;color: #4A4A4A;letter-spacing: 0;line-height: 30px;margin-top:25px;">Name : ' . $Name . '</h3>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td align="center"><h3 style="font-family: HelveticaNeue-Bold;font-size:16px;color: #4A4A4A;letter-spacing: 0;line-height: 30px;margin-top:25px;">' . $Message . '</h3>';
        $html .= '</td>';
        $html .= '</tr>';


        $send = $this->searchmail->send($define_param, $Subject, $html, $url);
        $this->session->set_flashdata('success', 'Invoice has been send.');
        redirect('invoice');
    }

}
