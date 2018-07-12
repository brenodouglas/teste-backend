<?php
namespace App\Service;

use SplFileObject;

class CountriesService
{
    const FILE_CACHE = "countries";

    public function loadCountries()
    {
        try {
            $file = file("http://www.umass.edu/microbio/rasmol/country-.txt", FILE_IGNORE_NEW_LINES);
            $fileIterator = new \ArrayIterator($file);
            $fileIterator->seek(3);

            $countries = new \ArrayIterator();

            while ($fileIterator->valid()) {
                list($letter, $name) = explode('   ', $fileIterator->current());
                $fileIterator->next();

                if ($fileIterator->valid()) {
                    $countries->append([
                        $letter,
                        $name,
                        "(${letter}) ${name}"
                    ]);
                }
            }

            $countries->uasort(function ($a, $b) {
                return strcmp($a[1], $b[1]);
            });
            $orderedCountries = array_reverse($countries->getArrayCopy());

            $this->putCache($orderedCountries);

            return $orderedCountries;
        } catch (\Exception $e) {
            return $this->getCachedCountries();
        }
    }

    private function getCachedCountries()
    {
        $fileFullPath = $this->getFileFullPath();
        return unserialize(file_get_contents($fileFullPath));
    }

    private function putCache(array $countries)
    {
        $this->clearCache();

        $fileFullPath = $this->getFileFullPath();
        file_put_contents($fileFullPath, serialize($countries));
    }

    private function clearCache()
    {
        @unlink($this->getFileFullPath());
    }

    private function getFileFullPath()
    {
        return CACHE_DIR."/app/".self::FILE_CACHE;
    }
}
