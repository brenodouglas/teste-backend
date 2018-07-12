<?php
declare(strict_types=1);
namespace Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\CountriesService;

final class ContriesServiceTest extends TestCase
{
    private $service;
    private $countries;

    protected function setUp()
    {
        $this->service = new CountriesService();
        $this->countries = $this->service->loadCountries();
    }

    public function testIfCountriesFileLoad()
    {
        $this->assertCount(3, $this->countries[0]);
    }

    public function testIfFirstCountryIsNato()
    {
        $this->assertEquals('ZW', $this->countries[0][0]);
        $this->assertEquals('Zimbabwe', $this->countries[0][1]);
        $this->assertEquals('(ZW) Zimbabwe', $this->countries[0][2]);
    }

    public function testIfLastCountryIsAndorra()
    {
        $lastCountry = end($this->countries);

        $this->assertEquals('AF', $lastCountry[0]);
        $this->assertEquals('Afghanistan', $lastCountry[1]);
        $this->assertEquals('(AF) Afghanistan', $lastCountry[2]);
    }

    public function testIfLoadAllCountries()
    {
        $this->assertCount(252, $this->countries);
    }

    public function testIfGenerateCacheFile()
    {
        $countries = $this->invokeMethod($this->service, 'getCachedCountries');
        $fileFullPath = $this->invokeMethod($this->service, 'getFileFullPath');
        
        $this->assertFileExists($fileFullPath);
        $this->assertCount(252, $countries);
        $this->assertEquals('ZW', $countries[0][0]);
        $this->assertEquals('Zimbabwe', $countries[0][1]);
        $this->assertEquals('(ZW) Zimbabwe', $countries[0][2]);

        $this->invokeMethod($this->service, 'clearCache');
    }

    private function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
