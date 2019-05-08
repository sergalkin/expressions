<?php
use PHPUnit\Framework\TestCase;

class ExpressionTest extends TestCase
{
    /** @test */
    function it_finds_a_string()
    {
        $regex = Expression::make()->find('www');
        $this->assertTrue($regex->test('www'));

        $regex = Expression::make()->then('www');
        $this->assertTrue($regex->test('www'));
    }

    /** @test */
    function it_check_for_anything()
    {
        $regex = Expression::make()->anything();

        $this->assertTrue($regex->test('foo'));
    }

    /** @test */
    function it_maybe_has_a_value()
    {
        $regex = Expression::make()->maybe('http');
        $this->assertTrue($regex->test('htpp'));
        $this->assertTrue($regex->test(''));
    }

    /** @test */
    function it_can_chain_method_calls()
    {
        $regex = Expression::make()->find('foo')->maybe('.')->then('biz');
        $this->assertTrue($regex->test('foo.biz'));
        $this->assertFalse($regex->test('fooXbiz'));
    }

    /** @test */
    function it_can_exclude_values()
    {
        $regex = Expression::make()
        ->find('foo')
        ->anythingBut('bar')
        ->then('biz');

        $this->assertTrue($regex->test('foobazbiz'));
        $this->assertFalse($regex->test('foobarbiz'));
    }
}
