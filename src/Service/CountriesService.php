<?php
namespace App\Service;

use SplFileObject;

class CountriesService
{
    public function loadCountries()
    {
        $file = new \ArrayIterator(file("http://www.umass.edu/microbio/rasmol/country-.txt", FILE_IGNORE_NEW_LINES));
        $file->seek(3);
        $countries = new \ArrayIterator();

        while ($file->valid()) {
            list($letter, $name) = explode('   ', $file->current());
            $file->next();

            if ($file->valid()) {
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
        
        return array_reverse($countries->getArrayCopy());
    }
}
