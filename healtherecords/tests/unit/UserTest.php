<?php
require_once dirname(__FILE__).'/post.php';

class UserTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
   
    protected function _before()
    {
    	$this->tester = new Post();
    	//$this->load->database('testing');
    }

    protected function _after()
    {
    	
    }

    // tests
    public function testMe()
    {
		$posts = $this->tester->getAll();
		$this->assertEquals(5, count($posts));
    }

};