<?php
namespace App\Controllers;

use Interop\Container\ContainerInterface;
use App\Service\CountriesService;

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
        return $this->view->render($response, 'index.twig', [
            'countries' => $this->service->loadCountries()
        ]);
    }
}
