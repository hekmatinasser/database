<?php

use Mockery as m;
use Illuminate\Database\Schema\Blueprint;

class SchemaBlueprintTest extends PHPUnit_Framework_TestCase {

	public function tearDown()
	{
		m::close();
	}


	public function testToSqlRunsCommandsFromBlueprint()
	{
		$conn = m::mock('Illuminate\Database\Connection');
		$conn->shouldReceive('statement')->once()->with('foo');
		$conn->shouldReceive('statement')->once()->with('bar');
		$grammar = m::mock('Illuminate\Database\Schema\Grammars\MySqlGrammar');
		$blueprint = $this->getMock('Illuminate\Database\Schema\Blueprint', array('toSql'), array('users'));
		$blueprint->expects($this->once())->method('toSql')->with($this->equalTo($grammar))->will($this->returnValue(array('foo', 'bar')));

		$blueprint->build($conn, $grammar);
	}

}