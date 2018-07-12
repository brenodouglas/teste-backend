<?php
declare(strict_types=1);
namespace Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\CsvService;
use App\Service\CountriesService;

class CsvServiceTest extends TestCase
{

    private $csvService;
    private $countries;

    public function setUp()
    {
        $service = new CountriesService();
        $this->countries = $service->loadCountries();
        $this->csvService = new CsvService();
    }

    public function testIfCsvFileIsGenerated()
    {
        $fullFilePath = $this->csvService->load($this->countries)
                                         ->putFile();
        
        $this->assertFileExists($fullFilePath);
    }

    public function testIfCsvIsValidAndIsFirstElementIsZw()
    {
        $countries = $this->csvService->load($this->countries)
                                      ->toArray();
        
        $this->assertCount(252, $countries);
        $this->assertEquals('ZW', $countries[0][0]);
        $this->assertEquals('Zimbabwe', $countries[0][1]);
        $this->assertEquals('(ZW) Zimbabwe', $countries[0][2]);
    }

    public function testIfCsvStringHasBrazil()
    {
        $csvString = $this->csvService->load($this->countries)
                                      ->toString();
        
        $this->assertContains('BR', $csvString);
        $this->assertContains('Brazil', $csvString);
        $this->assertContains('(BR) Brazil', $csvString);
    }
}
