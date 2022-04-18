<?php

namespace Controller;

use Core\Http\HttpResponse;
use Core\Http\JsonResponse;
use Core\Http\Request;
use Model\Turbine;

class AddressController extends Controller
{
    function ex(Request $request)
    {
        $response = (object)['error' => ''];
        $id = filter_var(
            $request->getParam('id'),
            FILTER_VALIDATE_INT,
            [
                'options' => [
                    'min_range' => 1
                ]
            ]
        );

        if ($id === false) {
            $response->error = 'Id invalid';
            return new JsonResponse($response, HttpResponse::HTTP_BAD_REQUEST);
        }

        $turbine = Turbine::get($id);
        if (is_null($turbine)) {
            $response->error = sprintf('Id %d not found', $id);
            return new JsonResponse($response, HttpResponse::HTTP_NOT_FOUND);
        }
        return new JsonResponse($turbine->getAddress(), HttpResponse::HTTP_OK);
    }
}