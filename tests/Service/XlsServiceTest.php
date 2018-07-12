<?php
declare(strict_types=1);
namespace Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\XlsService;
use App\Service\CountriesService;

class XlsServiceTest extends TestCase
{

    private $xlsService;
    private $countries;

    public function setUp()
    {
        $service = new CountriesService();
        $this->countries = $service->loadCountries();
        $this->xlsService = new XlsService();
    }

    public function testIfXlsFileIsGenerated()
    {
        $fullFilePath = $this->xlsService->load($this->countries)
                                         ->putFile();
        
        $this->assertFileExists($fullFilePath);

        @unlink($fullFilePath);
    }

    public function testIfCsvIsValidAndIsFirstElementIsZw()
    {
        $countries = $this->xlsService->load($this->countries)
                                      ->toArray();
        
        $this->assertCount(252, $countries);
        $this->assertEquals('ZW', $countries[0][0]);
        $this->assertEquals('Zimbabwe', $countries[0][1]);
        $this->assertEquals('(ZW) Zimbabwe', $countries[0][2]);
    }
}
