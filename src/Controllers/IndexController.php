<?php
namespace App\Controllers;

use Interop\Container\ContainerInterface;
use App\Service\CountriesService;
use App\Service\CsvService;
use App\Service\XlsService;

class IndexController
{

    protected $view;
    protected $service;

    public function __construct(ContainerInterface $container)
    {
        $this->view = $container->get('view');
        $this->service = new CountriesService();
    }

    public function index($request, $response)
    {
        return $this->view->render($response, 'index.twig', []);
    }
    
    public function csv($request, $response)
    {
        $csvService = new CsvService();
        $fileString = $csvService->load($this->service->loadCountries())
                                   ->toString();

        $body = $response->getBody();
        $body->write($fileString);

        return $response->withHeader('Content-Type', 'text/csv')
                        ->withHeader('Content-Disposition', 'attachment; filename="paises.csv"')
                        ->withHeader('Expires', '0')
                        ->withHeader('Pragma', 'no-cache')
                        ->withBody($body);
    }
    
    public function xls($request, $response)
    {
        $xlsService = new XlsService();
        $fileString = $xlsService->load($this->service->loadCountries())
                                   ->toString();

        $body = $response->getBody();
        $body->write($fileString);
        return $response->withHeader('Content-Type', 'application/octet-stream')
            ->withHeader('Content-Disposition', 'attachment; filename="paises.xlsx"')
            ->withHeader('Content-Transfer-Encoding', 'binary')
            ->withHeader('Expires', '0')
            ->withHeader('Pragma', 'no-cache')
            ->withBody($body);
    }
    
    public function list($request, $response)
    {
        return $this->view->render($response, 'list.twig', [
            'countries' => $this->service->loadCountries()
        ]);
    }
}
