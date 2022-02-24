<?php

use YOOtheme\Http\Request;
use YOOtheme\Http\Response;

class SourceControllerVehicle
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @throws \Exception
     *
     * @return Response
     */
    public static function vehicles(Request $request, Response $response)
    {
        $titles = [];
        $id = (int) $request('ids')[0];
        $vehicle = VehicleTypeProvider::get($id);

        $titles[$vehicle[0]->vehicleid] = $vehicle[0]->shortdescription;

        return $response->withJson((object) $titles);
    }
}
