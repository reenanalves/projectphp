<?php


class AddressController
{

    public function POSTANDPUTaddressV1($parameters)
    {
        try {

            $request = new POSTANDPUTaddressV1Request();
            $request->setValues($parameters);            
            $request->validate();

            $model = new AddressModel();
            $model->status = AddressModel::sEnable;
            $model->setValues($request->getValues());

            if($model->id > 0 && !AddressService::addressExists($model->id)){
                return new StatusCodeNotFound("Address not found!");
            }

            if(!CustomerService::customerExists($model->customer_id)){
                return new StatusCodeNotFound("Customer not found!");
            }

            $model = AddressService::store($model);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                return new StatusCodeCreated(["Id" => $model->id]);
            }else{
                return new StatusCodeOK(true);
            }


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

            $response = AddressService::findByPrimaryKey($request->Id);

            if(!$response){
                return new StatusCodeNotFound("Address not found!");
            }

            return new StatusCodeOK($response->getValues());

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function GETAddressesV1($parameters)
    {
        try {
            $request = new GETAddressesV1Request();
            $request->setValues($parameters);
            $request->validate();

            $data = AddressService::loadAll($request->Page, $request->RecordsByPage);

            if(count($data) <= 0){
                return new StatusCodeNotFound("Not found!");
            }

            $response = new PaginationTemplateResponse();
            $response->Page = $request->Page;            
            $response->RecordsByPage = $request->RecordsByPage;     
            $response->TotalRecords = AddressService::countAllRecords();  
                        
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

    public function DELETEAddressV1($parameters)
    {
        try {

            $request = new DELETEAddressV1Request();
            $request->setValues($parameters);
            $request->validate();

            if(!AddressService::addressExists($request->Id)){
                return new StatusCodeNotFound("Address not found!");
            }

            AddressService::delete($request->Id);

            return new StatusCodeOK(true);

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }
}
