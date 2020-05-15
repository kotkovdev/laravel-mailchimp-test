<?php

namespace Tests\App\Functional\Http\Controllers\User;

use Tests\App\TestCases\User\UserGroupTestCase;

class GroupControllerTest extends UserGroupTestCase
{
    public function testGroupCreateSuccess()
    {
        $this->post('/user/group', self::$createGroupData);
        $this->assertResponseOk();
        $response = $this->getArray($this->response);
        $this->assertArrayHasKey('group_id', $response);
    }

    public function testGroupShowSuccess()
    {
        $this->createGroup(self::$createGroupData);
        $this->get('/user/group/1');
        $this->assertResponseOk();
        $response = $this->getArray($this->response);
        $this->assertArrayHasKey('group_id', $response);
        $this->assertEquals(1, $response['group_id']);
    }

    public function testGroupListSuccess()
    {
        $this->createGroup(self::$createGroupData);
        $this->get('/user/group/list');
        $this->assertResponseOk();
        $response = $this->getArray($this->response);
        $this->assertArrayHasKey('group_id', $response[0]);
        $this->assertEquals(1, $response[0]['group_id']);
    }

    public function testGroupUpdateSuccess()
    {
        $this->createGroup(self::$createGroupData);
        $this->put('/user/group/1', ['name' => 'some group']);
        $this->assertResponseOk();
        $response = $this->getArray($this->response);
        $this->assertArrayHasKey('group_id', $response);
        $this->assertEquals('some group', $response['name']);
    }

    public function testGroupDeleteSuccess()
    {
        $this->createGroup(self::$createGroupData);
        $this->delete('/user/group/1');
        $this->assertResponseOk();
        $response = $this->getArray($this->response);
        $this->assertArrayHasKey('success', $response);
        $this->assertEquals('true', $response['success']);
    }
}