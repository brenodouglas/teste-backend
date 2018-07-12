<?php
namespace App\Service;

class CsvService implements FileServiceInterface
{
    private $data;

    public function load(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function putFile()
    {
        $fileName = CACHE_DIR."/app//".$this->getFileName().$this->getFileExtension();
        $output = fopen($fileName, 'w');
        foreach ($this->data as $country) {
            fputcsv($output, $country);
        }
        fclose($output);

        return $fileName;
    }
    
    public function toArray() : array
    {
        $fileName = $this->putFile();
        $arrayResult = array_map('str_getcsv', file($fileName));

        @unlink($fileName);

        return $arrayResult;
    }

    public function toString() : string
    {
        $fileName = $this->putFile();
        $content = file_get_contents($fileName);

        @unlink($fileName);

        return $content;
    }

    public function getFileName() : string
    {
        return 'result-countries'.date('dmYhi');
    }

    public function getFileExtension() : string
    {
        return '.csv';
    }
}
