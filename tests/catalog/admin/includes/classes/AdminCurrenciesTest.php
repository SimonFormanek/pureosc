<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2019-01-28 at 12:25:54.
 */
class AdminCurrenciesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var AdminCurrencies
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        tep_db_connect();
        $this->object = new AdminCurrencies();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers AdminCurrencies::format
     * @todo   Implement testFormat().
     */
    public function testFormat()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers AdminCurrencies::get_value
     */
    public function testGet_value()
    {
        $this->assertEquals('1.00000000', $this->object->get_value('CZK'));
    }

    /**
     * @covers AdminCurrencies::display_price
     * @todo   Implement testDisplay_price().
     */
    public function testDisplay_price()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
