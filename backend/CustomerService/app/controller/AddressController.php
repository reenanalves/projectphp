<?php


class AddressController
{

    public function POSTANDPUTaddressV1($parameters)
    {
        try {

            $request = new POSTANDPUTCustomerV1Request();
            $request->setValues($parameters);
            $request->validate();

            $model = new CustomerModel();
            $model->setValues($request->getValues());

            $model = CustomerService::store($model);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                return new StatusCodeOK(json_encode(["Id" => $model->id]));
            }else{
                return new StatusCodeOK('');
            }


        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function GETAddressV1($parameters)
    {
        try {

            $request = new GETCustomerV1Request();
            $request->setValues($parameters);
            $request->validate();

            $response = CustomerService::findByPrimaryKey($request->Id);

            return new StatusCodeOK(json_encode($response->getValues()));

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function GETAddressesV1($parameters)
    {
        try {
            $request = new GETCustomersV1Request();
            $request->setValues($parameters);

            $data = CustomerService::loadAll($request->Page, $request->RecordsByPage);

            $response = new PaginationTemplateResponse();
            $response->Page = $request->Page;            
            $response->RecordsByPage = $request->RecordsByPage;     
            $response->TotalRecords = CustomerService::countAllRecords();  
            
            $pages = Math::truncate($response->TotalRecords / $response->RecordsByPage);            
            $response->TotalPages = ($response->TotalRecords % $response->RecordsByPage) > 0 ? $pages + 1 : $pages;
            $response->Data = $data;

            return new StatusCodeOK(json_encode($response));

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function DELETEAddressV1($parameters)
    {
        try {

            $request = new DELETECustomerV1Request();
            $request->setValues($parameters);
            $request->validate();

            CustomerService::delete($request->Id);

            return new StatusCodeOK();

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }
}
