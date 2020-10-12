<?php

use PHPUnit\Framework\TestCase;

class ServicesTest extends TestCase
{

    public function testAuthenticate()
    {
        $tokenvalid = AuthenticateService::Authenticate("user", "1234567");

        try {
            AuthenticateService::isTokenValid("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyaWQiOiIxIiwibmFtZSI6IlJlbmFuIEFsdmVzIGRhIFNpbHZhIiwidXNlciI6InVzZXIiLCJleHBpcmVpbiI6MTYwMjM3MzI3OH0.b4LevMU1cv7mS1DduHp7qqLVhWmfYQn5Jd1MiOyyh9Y");
        } catch (Exception $e) {
            $this->assertEquals("Token expired!", $e->getMessage());
        }

        try {
            AuthenticateService::isTokenValid("klfsdfjkdjskfljkl3jljr2k3lk3ljf");
        } catch (Exception $e) {
            $this->assertEquals("Token invalid!", $e->getMessage());
        }

        try {
            AuthenticateService::isTokenValid("");
        } catch (Exception $e) {
            $this->assertEquals("Token is required!", $e->getMessage());
        }

        $this->assertEquals(true, AuthenticateService::isTokenValid($tokenvalid));

        try {
            AuthenticateService::getUserByToken("klfsdfjkdjskfljkl3jljr2k3lk3ljf");
        } catch (Exception $e) {
            $this->assertEquals("Token invalid!", $e->getMessage());
        }

        try {
            AuthenticateService::getUserByToken("");
        } catch (Exception $e) {
            $this->assertEquals("Token is required!", $e->getMessage());
        }

        $object = new UserModel();
        $object->id = "1";
        $object->user = "user";
        $object->name = "Renan Alves da Silva";

        $this->assertEquals($object->getValues(), AuthenticateService::getUserByToken($tokenvalid)->getValues());
    }
}
