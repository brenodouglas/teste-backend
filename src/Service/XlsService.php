<?php
namespace App\Service;

class XlsService implements FileServiceInterface
{
    public function load(array $data)
    {
        return $this;
    }
    
    public function putFile()
    {
        
    }
    
    public function toString() : string
    {
        return '';
    }
    
    public function toArray() : array
    {
        return [];
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
