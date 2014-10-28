<?php

namespace SMSApi\Proxy\Http;

use SMSApi\Api\Action\AbstractAction;
use SMSApi\Client;
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
        $path = '/test/path';
        $query = 'q1=test1&q2=test2';

        $uri = $proxy->createUri($query, $path);

        $this->assertInstanceOf('Smsapi\Proxy\Uri', $uri);
        $this->assertAttributeEquals('http', 'schema', $uri);
        $this->assertAttributeEquals('smsapi.pl', 'host', $uri);
        $this->assertAttributeEquals('80', 'port', $uri);
        $this->assertAttributeEquals($path, 'path', $uri);
        $this->assertAttributeEquals($query, 'query', $uri);
    }

    /**
     * @dataProvider proxyProvider
     */
    public function testCreateUriResultIsEqualToActionUriResult(Proxy $proxy)
    {
        $action = $this->getMockForAbstractClass(AbstractAction::class);

        $path = '/test/path';

        $action->expects($this->any())
            ->method('getPath')
            ->will($this->returnValue($path));

        $query = 'test=query';

        $action->expects($this->any())
            ->method('prepareQuery')
            ->will($this->returnValue($query));

        $action->proxy($proxy);
        $action->client(new Client('test'));

        $actionUri = $action->uri();

        $this->assertEquals($actionUri, $proxy->createUri($query, $path));
    }
}

