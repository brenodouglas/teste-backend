<?php
namespace App\Service;

interface FileServiceInterface
{
    public function load(array $data);
    
    public function putFile();
    
    public function toString() : string;
    
    public function toArray() : array;
    
    public function getFileName() : string;

    public function getFileExtension() : string;
}
