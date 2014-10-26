<?php

namespace SMSApi\Proxy\Http;

use SMSApi\Proxy\Proxy;

class ProxyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider proxyProvider
     */
    public function testIsProxyInstance($proxy)
    {
        $this->assertInstanceOf('Smsapi\Proxy\Proxy', $proxy);
    }

    public function proxyProvider()
    {
        return array(
            array(new Curl('http://smsapi.pl')),
            array(new Native('http://smsapi.pl')),
        );
    }

    /**
     * @dataProvider proxyProvider
     */
    public function testCreateUri(Proxy $proxy)
    {
        $uri = $proxy->createUri();

        $this->assertInstanceOf('Smsapi\Proxy\Uri', $uri);
        $this->assertAttributeEquals('http', 'schema', $uri);
        $this->assertAttributeEquals('smsapi.pl', 'host', $uri);
        $this->assertAttributeEquals('80', 'port', $uri);
        $this->assertAttributeEquals(null, 'path', $uri);
        $this->assertAttributeEquals(null, 'query', $uri);
    }
}
