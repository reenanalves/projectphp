<?php

use PHPUnit\Framework\TestCase;

class ServicesTest extends TestCase
{

    public $mockCustomers = [
        [
            "name" => "Joao da Silva",
            "birthday" => "1990-01-05",
            "document_cpf" => "1234567",
            "document_rg" => "12345",
            "phone" => "1222255",
            "status" => "1",
            "insert_expected" => "CPF inválido!",
            "update_expected" => false,
            "delete_expected" => false
        ],
        [
            "name" => "Joao da Silva",
            "birthday" => "1990-01-05",
            "document_cpf" => "94634369443",
            "document_rg" => "1234556",
            "phone" => "1222255",
            "status" => "1",
            "insert_expected" => true,
            "update" => [
                "name" => "Alberto da Silva"
            ],
            "update_expected" => true,
            "delete_expected" => true
        ],
        [
            "name" => "Joao da Silva",
            "birthday" => "1990-01-05",
            "document_cpf" => "94634369443",
            "document_rg" => "1234556",
            "phone" => "1222255",
            "status" => "1",
            "update" => [
                "name" => ""
            ],
            "insert_expected" => true,
            "update_expected" => "name is required!",
            "delete_expected" => false
        ]
    ];


    public function testAuthenticate()
    {

        $ini = Utils::getIniConfig();

        $url_request = $ini["config"]["url_userservice"] . "user/v1/Authenticate";

        $body = ["user" => "user", "pass" => "1234567"];

        $response = HttpRequest::request($url_request, 'POST', $body, null);

        $this->assertEquals("200", $response["Code"]);

        if ($response["Code"] != 200) {
            return;
        }

        $tokenvalid = $response["Body"]->Token;

        $this->assertEquals(false, AuthenticateService::Authenticate("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9eyJ1c2VyaWQiOiIxIiwibmFtZSI6IlJlbmFuIEFsdmVzIGRhIFNpbHZhIiwidXNlciI6InVzZXIiLCJleHBpcmVpbiI6MTYwMjM3MzI3OH0"));

        $this->assertEquals(false, AuthenticateService::Authenticate("klfsdfjkdjskfljkl3jljr2k3lk3ljf"));

        try {
            AuthenticateService::Authenticate("");
        } catch (Exception $e) {
            $this->assertEquals("Token is required!", $e->getMessage());
        }

        $this->assertEquals(true, AuthenticateService::Authenticate($tokenvalid));
    }

    public function testCustomers()
    {
        $mockCustomers = $this->mockCustomers;

        foreach ($mockCustomers as $key => $value) {

            $customer = new CustomerModel();
            try {
                $customer->setValues($value);
                $customerstored = CustomerService::store($customer);

                $this->assertTrue($customerstored->id > 0);

                $customer->id = $customerstored->id;
            } catch (Exception $e) {
                $this->assertEquals($value['insert_expected'], $e->getMessage());

                continue;
            }

            try {
                $customer->setValues($value['update']);
                $customerstored = CustomerService::store($customer);

                foreach ($value['update'] as $key => $valueupdate) {
                    $this->assertEquals($valueupdate, $customerstored->getValues()[$key]);
                }

            } catch (Exception $e) {
                $this->assertEquals($value['update_expected'], $e->getMessage());
                continue;
            }

            $this->assertEquals(CustomerModel::sDisable, CustomerService::delete($customer->id)->getValues()["status"]);
        }
    }
}
