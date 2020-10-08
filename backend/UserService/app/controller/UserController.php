<?php


class UserController
{

    public function AuthenticateV1($parameters)
    {
        try {

            $request = new AuthenticateV1Request();
            $request->setValues($parameters);
            $request->validate();

            $token = AuthenticateService::Authenticate($request->user, $request->pass);

            if (!$token) {
                return new StatusCodeNotFound("User not found!");
            }

            $response = ["Token" => $token];

            return new StatusCodeOK($response);

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function UpdateTokenV1($parameters)
    {
        try {
            $request = new UpdateTokenV1Request();
            $request->setValues($parameters);
            $request->validate();

            $token = AuthenticateService::UpdateToken($request->Token);

            $response = ["Token" => $token];

            return new StatusCodeOK($response);

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }

    public function TokenValidateV1($parameters)
    {
        try {
            $request = new ValidateTokenV1Request();
            $request->setValues($parameters);
            $request->validate();

            if(!AuthenticateService::isTokenValid($request->Token)){
                return new StatusCodeBadRequest("Token Invalid!");
            }
            
            $user = AuthenticateService::getUserByToken($request->Token);            

            return 
                new StatusCodeOK(                    
                        Utils::convertObjectToArray(
                            $user->getValues(),
                                ["id","user","name"]));

        } catch (Exception $e) 
        {
            return new StatusCodeBadRequest($e->getMessage());
        }
    }
}
