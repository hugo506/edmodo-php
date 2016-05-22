<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Domain\Student;
use App\Domain\HomeworkAnswer;

use App\User;

use App\Repositories\HomeworkRepository;

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
    
    protected function setUp()
    {
    	//db setup would go here, for now we'll use the main db
    	parent::setUp();
    }
    
    protected function teardown()
    {
    	//db cleanup would go here, for now we'll use the main db
    	parent::teardown();
    }
    
    public function testLoginPageHasUsernameText()
    {
    	$this->visit('/')->see('Username');
    }
    
    public function testStudentEntityHasName()
    {
    	$name = 'testname';
    	
    	$student = new Student(0, $name, '');
    	    	
    	$this->assertEquals($name, $student->name);    	    
    }
    
    public function testHomeworkAnswerEntityCompareDate()
    {
    	$answerNew = new HomeworkAnswer(0, 0, 0, '', '2016-01-01');
    	$answerOld= new HomeworkAnswer(0, 0, 0, '', '2015-01-01');
    	
    	$this->assertEquals(
    			$answerNew->compareDate($answerOld),
    			true);
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
    
    
    public function testStudentDashboard()
    {
    	//login the student
    	$user = User::where('user_name', 'student')->first();
    	$this->be($user);
    	
    	$response = $this->call('GET', 'dashboard');
    
    	$this->assertEquals(200, $response->status());
    	$this->assertContains('My Assignments', $response->getContent());
    }
    
    public function testHomeworkRepositoryfindByIdWithAnswers()
    {
    	$homework = 1;
    	$student = 1;
    	$answer = 52;
    	
    	$repository = new HomeworkRepository();
    	$results = $repository->findByIdWithAnswers($homework, $student);
    	
    	
    	$this->assertEquals('Math 101', $results->title);
    	$this->assertEquals('Bill Murray', $results->studentAnswers[$student]['student']->name);
    	$this->assertEquals('Foo', $results->studentAnswers[$student]['answers'][$answer]->answer);
    	
    }
}
