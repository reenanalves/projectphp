<?php


class CustomerController
{

    public function POSTANDPUTCustomerV1($parameters)
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

    public function GETCustomerV1($parameters)
    {
        try {

            $request = new GETCustomerV1Request();
            $request->setValues($parameters);
            $request->validate();

            $response = CustomerService::findByPrimaryKey($request->Id);

            if(!$response){
                return new StatusCodeNotFound("");
            }

            return new StatusCodeOK(json_encode($response->getValues()));

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function GETCustomersV1($parameters)
    {
        try {
            $request = new GETCustomersV1Request();
            $request->setValues($parameters);
            $request->validate();

            $data = CustomerService::loadAll($request->Page, $request->RecordsByPage);

            if(count($data) <= 0){
                return new StatusCodeNotFound("");
            }

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

    public function DELETECustomerV1($parameters)
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
