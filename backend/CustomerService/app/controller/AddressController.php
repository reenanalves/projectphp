<?php


class AddressController
{

    public function POSTANDPUTaddressV1($parameters)
    {
        try {

            $request = new POSTANDPUTAddressV1Request();
            $request->setValues($parameters);
            $request->validate();

            $model = new AddressModel();
            $model->setValues($request->getValues());

            $model = AddressService::store($model);

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

            $request = new GETAddressV1Request();
            $request->setValues($parameters);
            $request->validate();

            $response = AddressService::findByPrimaryKey($request->Id);

            if(!$response){
                return new StatusCodeNotFound();
            }

            return new StatusCodeOK(json_encode($response->getValues()));

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
                return new StatusCodeNotFound("");                
            }

            $response = new PaginationTemplateResponse();
            $response->Page = $request->Page;            
            $response->RecordsByPage = $request->RecordsByPage;     
            $response->TotalRecords = AddressService::countAllRecords();  
            
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

            $request = new DELETEAddressV1Request();
            $request->setValues($parameters);
            $request->validate();

            AddressService::delete($request->Id);

            return new StatusCodeOK();

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }
}
