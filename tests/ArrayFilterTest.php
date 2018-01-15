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
        $filter = 'name == Hutchinson';
        $condition = explode(' ', $filter);

        $res = $this->filter[ $filter ];

        foreach ($res as $value)
        {
            $this->assertEquals($condition[2], $value[ $condition[0] ]);
        }
    }

    public function testFilterBalanceGt()
    {
        $filter = 'balance > 5';

        $res = $this->filter[ $filter ];

        foreach ($res as $value)
        {
            $this->assertGreaterThan(5, $value['balance']);
        }
    }

    public function testFilterAndLogic()
    {
        $filter = 'suspicious == false && balance != 0';

        $res = $this->filter[ $filter ];

        foreach ($res as $value)
        {
            $this->assertEquals(false, $value['suspicious']);
            $this->assertNotEquals(0, $value['balance']);
        }
    }

    public function testFilterAndLogic2()
    {
        $filter = 'suspicious == true && eyeColor == brown';

        $res = $this->filter[ $filter ];

        foreach ($res as $value)
        {
            $this->assertEquals(true, $value['suspicious']);
            $this->assertEquals('brown', $value['eyeColor']);
        }
    }

    public function testFilterOrLogic()
    {
        $filter = 'name == Rosemary || name == ride';

        $res = $this->filter[ $filter ];

        foreach ($res as $value)
        {
            $this->assertContains($value['name'], ['Rosemary', 'Gregory']);
        }
    }
}
