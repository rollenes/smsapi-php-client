<?php

namespace SMSApi\Api\Action\Phonebook;

use SMSApi\Client;

class ContactGetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ContactGet
     */
    private $getContactAction;

    protected function setUp()
    {
        $addContactAction = new ContactGet();

        $proxy = $this->getMock('\SMSApi\Proxy\Http\Native', array(), ['']);

        $proxy->expects($this->any())
            ->method('execute')
            ->will($this->returnValue('{}'));

        $addContactAction->client(new Client('test'));
        $addContactAction->proxy($proxy);

        $this->getContactAction = $addContactAction;
    }

    public function testUriWithGroups()
    {
        $query = $this->getContactAction->prepareQuery();

        $this->assertEquals('username=test&password=&with_groups=1', $query);
    }

}
 