<?php
namespace App\Service;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class XlsService implements FileServiceInterface
{
    private $data;
    
    public function load(array $data)
    {
        $this->data = $data;
        return $this;
    }
    
    public function putFile()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($this->data as $key => $data) {
            $keySheet = $key + 1;
            $sheet->setCellValue('A'.$keySheet, $data[0]);
            $sheet->setCellValue('B'.$keySheet, $data[1]);
            $sheet->setCellValue('C'.$keySheet, $data[2]);
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = CACHE_DIR.'/app/'.$this->getFileName().$this->getFileExtension();
        $writer->save($fileName);

        return $fileName;
    }
    
    public function toString() : string
    {   
        $fileName = $this->putFile();
        $content = file_get_contents($fileName);

        @unlink($fileName);
        
        return $content;
    }
    
    public function toArray() : array
    {
        return $this->data;
    }
    
    public function getFileName() : string
    {
        return 'result-countries'.date('dmYhi');
    }

    public function getFileExtension() : string
    {
        return '.xlsx';
    }
}
