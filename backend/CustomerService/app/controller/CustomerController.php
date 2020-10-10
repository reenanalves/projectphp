<?php


class CustomerController
{

    public function POSTCustomerV1($parameters)
    {
        try {

            $request = new POSTCustomerV1Request();
            $request->setValues($parameters);            
            $request->validate();

            $model = new CustomerModel();
            $model->status = CustomerModel::sEnable;
            $model->setValues($request->getValues());

            if($model->id > 0 && !CustomerService::customerExists($model->id)){
                return new StatusCodeNotFound("Customer not found!");
            }

            $model = CustomerService::store($model);

            
            return new StatusCodeCreated(["Id" => $model->id]);


        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function PUTCustomerV1($parameters)
    {
        try {

            $request = new PUTCustomerV1Request();
            $request->setValues($parameters);            
            $request->validate();

            $model = new CustomerModel();
            $model->status = CustomerModel::sEnable;
            $model->setValues($request->getValues());

            if($model->id > 0 && !CustomerService::customerExists($model->id)){
                return new StatusCodeNotFound("Customer not found!");
            }

            $model = CustomerService::store($model);

            return new StatusCodeOK("");


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
                return new StatusCodeNotFound("Customer not found!");
            }

            return new StatusCodeOK($response->getValues());

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
                return new StatusCodeNotFound("Customer not found!");
            }

            $response = new PaginationTemplateResponse();
            $response->Page = $request->Page;            
            $response->RecordsByPage = $request->RecordsByPage;     
            $response->TotalRecords = CustomerService::countAllRecords();  
                        
            $pages = Math::truncate($response->TotalRecords / $response->RecordsByPage);            
            $response->TotalPages = ($response->TotalRecords % $response->RecordsByPage) > 0 ? $pages + 1 : $pages;
            $response->Data = $data;
            $response->NextPage = $response->TotalPages > $response->Page ? $response->Page + 1 : $response->Page;
            $response->PriorPage = $response->Page > 1 ? $response->Page - 1 : 1;

            return new StatusCodeOK($response);

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

            if(!CustomerService::customerExists($request->Id)){
                return new StatusCodeNotFound("Customer not found!");
            }

            CustomerService::delete($request->Id);

            return new StatusCodeOK("");

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }
}
