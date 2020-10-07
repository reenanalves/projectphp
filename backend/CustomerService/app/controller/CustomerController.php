<?php


class CustomerController
{

    public function POSTANDPUTCustomerV1($parameters)
    {
        try {

            $request = new POSTANDPUTCustomerV1Request();
            $request->setValues($parameters);
            $request->validate();

            $response = [];

            return new StatusCodeOK(json_encode($response));

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function GETCustomerV1($parameters)
    {
        try {

            $request = new GETCustomerV1Request();
            $request->setValues($parameters);
            $request->validate();

            $response = [];

            return new StatusCodeOK(json_encode($response));

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function GETCustomersV1($parameters)
    {
        try {
            $response = [];

            return new StatusCodeOK(json_encode($response));

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function DELETECustomerV1($parameters)
    {
        try {

            $request = new DELETECustomerV1Request();
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
