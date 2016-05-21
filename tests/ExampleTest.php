<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Domain\Student;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function skip_testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }
    
    public function testLoginPageHasUsernameText()
    {
    	$this->visit('/')
    		->see('Username');
    }
    
    public function testStudentEntityHasName()
    {
    	$name = 'testname';
    	
    	$student = new Student(0, $name, '');
    	    	
    	$this->assertEquals($name, $student->name);    	    
    }
    
    
    public function testLoginFail()
    {
    	$response = $this->call('POST', 'login');
    	
    	$this->assertEquals(200, $response->status());
    	$this->assertContains('Login Error', $response->getContent());
    }
    
    public function testLoginPasses()
    {
    	$response = $this->call('POST', 'login', ['username' => 'student']);
    	    	
    	$this->assertEquals(302, $response->status());
    	$this->assertContains('dashboard', $response->headers->get('Location'));
    }
}
