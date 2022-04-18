<?php

namespace Controller;

use Core\Http\HttpResponse;
use Core\Http\JsonResponse;
use Core\Http\Request;

class Controller
{
    protected $addresses = [];

    function ex(Request $request)
    {
        $response = (object)['success' => false, 'error' => ''];
        $this->rcd();
        $id = $request->getParam('id');
        if (count($this->addresses) < (int)$id) {
            return new JsonResponse($response->error = sprintf('Invalid id sent: %s', $id), HttpResponse::HTTP_BAD_REQUEST);
        }
        $address = $this->addresses[$id];
        return new JsonResponse($address, HttpResponse::HTTP_OK);
    }

    function rcd()
    {
        $file = fopen('turbines.csv', 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            $this->addresses[] = [
                $line[0],
                $line[1],
                $line[2]
            ];
        }

        fclose($file);
    }
}