<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    public function testGetDefaultUser()
    {
        $this->withoutMiddleware();

        $this->get('api/v1/users/1')
            ->seeStatusCode(200)
            ->seeJson([ 'email' => 'admin@tasker.com' ]);
    }
    
}
