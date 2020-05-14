<?php
namespace Tests\App\Functional\Http\Controllers\User;

use \Tests\App\TestCases\User\UserTestCase;

class UserControllerTest extends UserTestCase
{
    public function testUserCreateSuccess()
    {
        $this->post('/user/', self::$createUserData);
        $this->assertResponseOk();
        $response = json_decode($this->response->getContent(), true);
        $this->assertArrayHasKey('id', $response);
        $this->assertNotNull($response['id']);
    }

    public function testUserCreateDuplicateEmailError()
    {
        $this->createUser(self::$createUserData);
        $this->post('/user/', self::$createUserData);
        $this->assertResponseStatus(500);
        $response = json_decode($this->response->getContent(), true);
        $this->assertArrayHasKey('message', $response);
    }

    public function testUserCreateBadDataError()
    {
        $userData = self::$createUserData;
        $userData['first_name'] = '';
        $this->createUser($userData);
        $this->post('/user/', self::$createUserData);
        $this->assertResponseStatus(500);
        $response = json_decode($this->response->getContent(), true);
        $this->assertArrayHasKey('message', $response);
    }

    public function testUserReadSuccess()
    {
        $this->createUser(self::$createUserData);
        $this->get('/user/1');
        $this->assertResponseOk();
        $response = json_decode($this->response->getContent(), true);
        $this->assertArrayHasKey('id', $response);
        $this->assertEquals(self::$createUserData['email'], $response['email']);
    }

    public function testUserReadUnknownUser()
    {
        $this->get('/user/1');
        $this->assertResponseStatus(500);
        $response = json_decode($this->response->getContent(), true);
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals('User not found', $response['message']);
    }

    public function testListResponse()
    {
        $this->createUser(self::$createUserData);
        $this->get('/user/list');
        $this->assertResponseOk();
        $response = json_decode($this->response->getContent(), true);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertEquals(self::$createUserData['email'], $response[0]['email']);
    }

    public function testEmptyUsersListResponse()
    {
        $this->get('/user/list');
        $this->assertResponseStatus(500);
        $response = json_decode($this->response->getContent(), true);
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals('Users is empty', $response['message']);
    }
}