<?php

namespace Controller;

use Core\Http\HttpResponse;
use Core\Http\JsonResponse;
use Core\Http\Request;
use Model\Turbine;

class AddressController extends Controller
{
    protected $addresses = [];

    function ex(Request $request)
    {
        $response = (object)['error' => ''];
        $this->rcd();
        $id = $request->getParam('id');
        if (count($this->addresses) < (int)$id) {
            $response->error = sprintf('Invalid id sent: %s', $id);
            return new JsonResponse($response, HttpResponse::HTTP_BAD_REQUEST);
        }

        $address = null;
        foreach ($this->addresses as $turbine) {
            if ($turbine->getId() === (int)$id) {
                $address = $turbine->getAddress();
            }
        }
        if (is_null($address)) {
            $response->error = sprintf('Id %s not found', $id);
            return new JsonResponse($response, HttpResponse::HTTP_NOT_FOUND);
        }
        return new JsonResponse($address, HttpResponse::HTTP_OK);
    }

    function rcd()
    {
        $file = fopen('turbines.csv', 'r');
        $i = 0;
        while (($line = fgetcsv($file)) !== FALSE) {
            $turbine = new Turbine();
            $turbine->setId(++$i);
            $turbine->setIdentifier($line[0]);
            $turbine->setProducer($line[1]);
            $turbine->setLatitude((float)$line[2]);
            $turbine->setLongitude((float)$line[3]);
            $this->addresses[] = $turbine;
        }

        fclose($file);
    }
}