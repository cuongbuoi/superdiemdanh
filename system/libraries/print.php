<?php 
require_once 'Classes/PHPExcel.php';
 class CI_print
{
    public function report($data)
    {
        
        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(12);

        $excel->getActiveSheet()->setTitle('Bảng điểm');
        $excel->getActiveSheet()->setCellValue('C1', 'Lớp: '.$data[0]['tenlop'].'');
        $excel->getActiveSheet()->setCellValue('C2', 'Môn: '.$data[0]['tenmonhoc'].'');
        $excel->getActiveSheet()->setCellValue('A4', 'STT');
        $excel->getActiveSheet()->setCellValue('B4', 'MSSV');
        $excel->getActiveSheet()->setCellValue('C4', 'Họ và tên');
        $excel->getActiveSheet()->setCellValue('D4', 'Nữ');
        $excel->getActiveSheet()->setCellValue('E4', 'Điểm CC');
        $excel->getActiveSheet()->setCellValue('F4', 'Điểm GK');
        $excel->getActiveSheet()->setCellValue('G4', 'Điểm TX');
        $excel->getActiveSheet()->setCellValue('H4', 'Điểm TB');
        $excel->getActiveSheet()->getStyle("C1")->getFont()->setSize(30);
        $excel->getActiveSheet()->getStyle("C2")->getFont()->setSize(30);
        $excel->getActiveSheet()->getStyle("B2")->getFont()->setSize(20);
        $excel->getActiveSheet()->getStyle("B2")->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle("A4")->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle("B4")->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle("C4")->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle("D4")->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle("E4")->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle("F4")->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle("G4")->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle("H4")->getFont()->setBold(true);
        
        
        
        $numRow = 4;
        $stt=0;
        foreach($data as $row){
            $stt++;
            $numRow++;
            $diemtb=round(floatval(($row['diem1']+$row['diem2']+$row['diem3'])/3),2);
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt); 
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $row['mssv']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $row['hoten']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $row['gioitinh']=='Nữ'? "x":"");
            $excel->getActiveSheet()->setCellValue('E'.$numRow, $row['diem1']);
            $excel->getActiveSheet()->setCellValue('F'.$numRow, $row['diem2']);
            $excel->getActiveSheet()->setCellValue('G'.$numRow, $row['diem3']);
            $excel->getActiveSheet()->setCellValue('H'.$numRow, $diemtb);
            
        }
        $excel->getActiveSheet()->getStyle('A4:H'.$numRow.'')->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );
        $excel->getActiveSheet()->getStyle('D4:H'.$numRow.'')->applyFromArray(
            array(
           
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    )
                
            )
        );
        $excel->getActiveSheet()->getStyle('A1:H'.$numRow.'')->getFont()->setName('Times New Roman');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="data.xls"');
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');

    }
    public function read($name,$malop)
    {
       
            $objFile = PHPExcel_IOFactory::identify($name);
            $objData = PHPExcel_IOFactory::createReader($objFile);
            
            $objData->setReadDataOnly(true);
            
            $objPHPExcel = $objData->load($name);
            
            $sheet  = $objPHPExcel->setActiveSheetIndex(0);
            $Totalrow = $sheet->getHighestRow();
            $data=[];
            for($i=9;$i<=$Totalrow;$i++)
            {
                if($sheet->getCellByColumnAndRow(0, $i)->getValue()!='' && $sheet->getCellByColumnAndRow(2, $i)!='' )
                {
                    $data[]=array(
                    'hoten'=>$sheet->getCellByColumnAndRow(2, $i)->getValue()." ".$sheet->getCellByColumnAndRow(3, $i)->getValue(),
                    'mssv'=>$sheet->getCellByColumnAndRow(1, $i)->getValue(),
                    'gioitinh'=>'Nam',
                    'malop'=>$malop
                    );
                }
               
            }
            return $data;
        
        //return $name;
    }

}
?>