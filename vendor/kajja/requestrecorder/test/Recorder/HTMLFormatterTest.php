<?php

namespace Kajja\Recorder;

/**
 * Test of HTMLFormatter class.
 *
 *
 */
class HTMLFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     *
     *
     */
    public function testgetOutput()
    {
        $formatter = new HTMLFormatter();

        // Testing when a session has a single record
        $record = [ 
            [
                'session'   => '123456',
                'id'        => 1,
                'uri'       => '/test/test.php',
                'method'    => 'post',
                'date'      => 'xxxx-xx-xx'
            ]
        ];

        $expected = '<table><thead><tr>' . 
            '<th><kbd>session</kbd></th>' . 
            '<th><kbd>id</kbd></th>' . 
            '<th><kbd>uri</kbd></th>' . 
            '<th><kbd>method</kbd></th>' . 
            '<th><kbd>date</kbd></th></tr></thead>' .
            '<tbody><tr>' .
            '<td><kbd>123456</kbd></td>' .
            '<td><kbd>1</kbd></td>' .
            '<td><kbd>/test/test.php</kbd></td>' .
            '<td><kbd>post</kbd></td>' .
            '<td><kbd>xxxx-xx-xx</kbd></td>' .
            '</tr></tbody></table>';

        $actual = $formatter->getOutput($record);

        $this->assertEquals($expected, $actual, "Generated HTML table (single record) not as expected");

        // Testing when a session has multiple records
        $record[] = [
                'session'   => '123456',
                'id'        => 2,
                'uri'       => '/test/test.php',
                'method'    => 'post',
                'date'      => 'xxxx-xx-xx'];
        
        $expected = '<table><thead><tr>' . 
            '<th><kbd>session</kbd></th>' . 
            '<th><kbd>id</kbd></th>' . 
            '<th><kbd>uri</kbd></th>' . 
            '<th><kbd>method</kbd></th>' . 
            '<th><kbd>date</kbd></th></tr></thead>' .
            '<tbody>' . 
            '<tr>' .
                '<td><kbd>123456</kbd></td>' .
                '<td><kbd>1</kbd></td>' .
                '<td><kbd>/test/test.php</kbd></td>' .
                '<td><kbd>post</kbd></td>' .
                '<td><kbd>xxxx-xx-xx</kbd></td>' . 
            '</tr><tr>' .
                '<td><kbd></kbd></td>' .
                '<td><kbd>2</kbd></td>' .
                '<td><kbd>/test/test.php</kbd></td>' .
                '<td><kbd>post</kbd></td>' .
                '<td><kbd>xxxx-xx-xx</kbd></td>' .
            '</tr></tbody></table>';

        $actual = $formatter->getOutput($record);

        $this->assertEquals($expected, $actual, "Generated HTML table (multiple records) not as expected");

    }
}