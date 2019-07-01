<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\DotNotation;

class DotNotationTest extends TestCase
{
    public function test_access_single_array()
    {
        $expected = true;
        $array = ['hello' => true];
        $actual = DotNotation::get($array, 'hello');
        $this->assertEquals($actual, $expected);
    }

    public function test_dot_notation()
    {
        $expected = [
            'host' => 'localhost',
            'username' => 'username',
            'password' => 'password'
        ];
        $array = [
            'config' => [
                'database' => $expected
            ]
        ];

        $actual = DotNotation::get($array, 'config.database');
        $this->assertEquals($actual, $expected);
    }

    public function test_access_nested()
    {
        $expected = 'hello';
        $array = [
            'hi' => [
                'hello' => [
                    'more' => 'hello',
                    'hello' => 'world'
                ]
            ],
            'this' => [
                'also' => true
            ]
        ];

        $actual = DotNotation::get($array, 'hi.hello.more');
        $this->assertEquals($actual, $expected);
    }

    public function test_when_key_doesnt_exist()
    {
        $expected = null;
        $array = ['hello' => ['world' => false]];

        $actual = DotNotation::get($array, 'world.hello');
        $this->assertEquals($actual, $expected);
    }

    public function test_partial_keys_exit()
    {
        $expected = null;
        $array = ['bob' => ['jane' => ['name' => 'cool']]];

        $actual = DotNotation::get($array, 'bob.jane.email');
        $this->assertEquals($actual, $expected);
    }

    public function test_super_nested()
    {
        $expected = 'found me';
        $array = ['a' => ['b' => ['c' => ['d' => ['e' => 'found me']]]]];

        $actual = DotNotation::get($array, 'a.b.c.d.e');
        $this->assertEquals($actual, $expected);
    }

    public function test_invalid_key()
    {
        $expected = null;
        $actual = DotNotation::get(['hello' => 'world'], 'null');

        $this->assertEquals($actual, $expected);
    }

    public function test_it_can_return_a_default()
    {
        $expected = 'default';
        $array = ['not' => ['there' => 'cool']];
        $actual = DotNotation::get($array, 'hello.world', $expected);

        $this->assertEquals($actual, $expected);
    }
}