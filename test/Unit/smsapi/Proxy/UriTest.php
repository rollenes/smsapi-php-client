<?php

namespace SMSApi\Proxy;

class UriTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Uri
     */
    private $uri;

    protected function setUp()
    {
        $this->uri = new Uri('http', 'example.com', 80, '/path', 'q1=test1');
    }

    public function testCreatedUri()
    {
        $this->assertAttributeSame('http', 'schema', $this->uri);
        $this->assertAttributeSame('example.com', 'host', $this->uri);
        $this->assertAttributeSame(80, 'port', $this->uri);
        $this->assertAttributeSame('/path', 'path', $this->uri);
        $this->assertAttributeSame('q1=test1', 'query', $this->uri);
    }

    public function testGetSchema()
    {
        $this->assertSame('http', $this->uri->getSchema());
    }

    public function testGetHost()
    {
        $this->assertSame('example.com', $this->uri->getHost());
    }

    public function testGetPort()
    {
        $this->assertSame(80, $this->uri->getPort());
    }

    public function testGetPath()
    {
        $this->assertSame('/path', $this->uri->getPath());
    }

    public function testSetPath()
    {
        $this->uri->setPath('/test/path');

        $this->assertAttributeSame('/test/path', 'path', $this->uri);
    }

    public function testGetQuery()
    {
        $this->assertSame('q1=test1', $this->uri->getQuery());
    }

    public function testSetQuery()
    {
        $this->uri->setQuery('q1=test1&q2=test2');

        $this->assertAttributeSame('q1=test1&q2=test2', 'query', $this->uri);
    }
}
