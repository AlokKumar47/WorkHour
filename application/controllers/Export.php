<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
		$this->LoginModel->sessionvalid();
		// $this->load->model('Export_model');
	}
	public function index(){
		$data['title'] = "Excel WorkSheet";
		$data['excelfeedback'] = $this->excel->worklist();
	}
	public function createEXL(){
		$this->load->model('LoginModel');
		$this->LoginModel->sessionvalid();
		
		$this->load->library('Excel');
		$object = new PHPExcel();
		
		// $data['title'] = "Excel WorkSheet";
		// $data['excelfeedback'] = $this->excel->worklist();
		
		$object->setActiveSheetIndex(0);
		$heading = "WorkSheet";
		$object->getActiveSheet()->setCellValueByColumnAndRow(3, 1, $heading);
		$table_columns = array('Project','Work','Description','Duration','Date');
		$column = 1;
		
		$object->getActiveSheet()->freezePane('A4');

		foreach($table_columns as $field){
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);
			$column++;
		}
		
		/**autosize*/
		for ($col = 'B'; $col != 'G'; $col++) {
			$object->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
		// Get Valid Data
		$this->load->model('DashModel');
		$data = $this->DashModel->validWork();
		
		// echo "<pre>";
		// print_r($data);exit;
		$excel_row = 4;
		$numrows = 0;
		foreach($data as $row){
			// echo $row->pname;
			$numrows++;
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->pname);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->work);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->description);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->duration);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->date);
			$excel_row++;
		}
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		
		
		/** Borders for all data */
		
		$styleArray = array(
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THICK,
					'color' => array('argb' => '008000'),
				),
			),
		);
		$numrows += 3;
		// $object->getActiveSheet()->getStyle('B2:G8')->applyFromArray($styleArray);
		$object->getActiveSheet()->getStyle('B2:F'.$numrows)->applyFromArray($styleArray);
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="WorkSheet.xlsx"');
		$object_writer->save('php://output');
	}
	
	function pdf(){
		$this->load->model('LoginModel');
		$this->LoginModel->sessionvalid();
		
		$this->load->library('Pdf');
		// $this->load->view('view_file');
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('WorkSheet');
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->setHeaderFont(array('', '', 35));
		$pdf->SetFont("ubuntur", '', 12, '');
		
		// convert TTF font to TCPDF format and store it on the fonts folder
		// $fontname = TCPDF_FONTS::addTTFfont('/path-to-font/FreeSerifItalic.ttf', 'TrueTypeUnicode', '', 96);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		// $pdf->Write(10, 'Workshet');
		
		$table = " ";
		$table .= '<html><head>
				<style>table.minimalistBlack {
				  border: 3px solid #000000;
				  width: 100%;
				  text-align: left;
				  border-collapse: collapse;
				}
				table.minimalistBlack td, table.minimalistBlack th {
				  border: 1px solid #000000;
				  padding: 5px 4px;
				}
				table.minimalistBlack tbody td {
				  font-size: 13px;
				}
				table.minimalistBlack thead {
				  background: #CFCFCF;
				  background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
				  background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
				  background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
				  border-bottom: 3px solid #000000;
				}
				table.minimalistBlack thead th {
				  font-size: 15px;
				  font-weight: bold;
				  color: #000000;
				  text-align: left;
				}
				table.minimalistBlack tfoot td {
				  font-size: 14px;
				}</style></head>
				<body><h2>Complete WorkHour Sheet</h2>
				  <table class="minimalistBlack" style="text-align: center, width:100%">
				  <thead>
					<tr>
					  <th style="width:5%, text-align: center">#</th>
					  <th style="text-align: center">Project</th>
					  <th style="text-align: center">Work Title</th>
					  <th style="width:30%, text-align: center">Work Desc.</th>
					  <th style="width:15%">Duration</th>
					</tr>
				  </thead><tbody>';
		
		// Get Valid Data
		$this->load->model('DashModel');
		$data = $this->DashModel->validWork();
		// var_dump($data);exit;
		foreach ($data as $row)
		{
			$name = $row->pname;
			$wname = $row->work;
			$wdescname = $row->description;
			$dur = $row->duration;
			$i = 1;
			
			$table .= '<tr>
						<td style="width:5%, text-align: center">'.$i++.'</td>
						<td style="text-align: center">'.$name.'</td>
						<td style="text-align: center">'.$wname.'</td>
						<td style="width:30%, text-align: center">'.$wdescname.'</td>
						<td style="width:15%, text-align: center">'.$dur.'</td>
					</tr>';
		}
		
		$table .= '</tbody></table></body></html>';
		$pdf->AddPage();
		$pdf->writeHTML($table);
		
		
		// echo $table;exit;
		
		// $pdf->writeHTML($tbl, true, false, false, false, '');
		$pdf->Output('Workhour.pdf', 'D');
	}
}
?>