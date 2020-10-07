<?php


class AddressController
{

    public function POSTANDPUTaddressV1($parameters)
    {
        try {

            $request = new POSTANDPUTaddressV1Request();
            $request->setValues($parameters);
            $request->validate();

            $response = [];

            return new StatusCodeOK(json_encode($response));

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function GETAddressV1($parameters)
    {
        try {

            $request = new GETAddressV1Request();
            $request->setValues($parameters);
            $request->validate();

            $response = [];

            return new StatusCodeOK(json_encode($response));

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function GETAddressesV1($parameters)
    {
        try {
            $response = [];

            return new StatusCodeOK(json_encode($response));

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function DELETEAddressV1($parameters)
    {
        try {

            $request = new DELETEAddressV1Request();
            $request->setValues($parameters);
            $request->validate();

            $response = [];

            return new StatusCodeOK(json_encode($response));

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }
}
