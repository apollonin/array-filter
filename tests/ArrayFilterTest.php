<?php

namespace Tests;

use Seredenko\ArrayFilter;

class ArrayFilterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArrayFilter
     */
    private $filter;

    public function setUp()
    {
        $this->filter = new ArrayFilter(json_decode(file_get_contents(__DIR__ . '/testData.json'), true));
    }

    public function testFilterByNameExplicit()
    {
        $res = $this->filter['name == Hutchinson'];

        foreach ($res as $value) {
            $this->assertEquals('Hutchinson', $value['name']);
        }
    }

    public function testFilterBalanceGt()
    {
        $res = $this->filter['balance > 5'];

        foreach ($res as $value) {
            $this->assertGreaterThan(5, $value['balance']);
        }
    }

    public function testFilterAndLogic()
    {
        $res = $this->filter['suspicious == false && balance != 0'];

        foreach ($res as $value) {
            $this->assertEquals(false, $value['suspicious']);
            $this->assertNotEquals(0, $value['balance']);
        }
    }

    public function testFilterAndLogic2()
    {
        $res = $this->filter['suspicious == true && eyeColor == brown'];

        foreach ($res as $value) {
            $this->assertEquals(true, $value['suspicious']);
            $this->assertEquals('brown', $value['eyeColor']);
        }
    }

    public function testFilterOrLogic()
    {
        $res = $this->filter['name == Rosemary || name == Gregory'];

        foreach ($res as $value) {
            $this->assertContains($value['name'], ['Rosemary', 'Gregory']);
        }
    }

    public function testSetNewValueForFilteredArray()
    {
        $res = $this->filter['name == Gregory || balance == 6.99']['name:balance'];
        $res['balance'] = 0;

        foreach ($res as $value) {
            $this->assertEquals(0, $value['balance']);
        }
    }
}
