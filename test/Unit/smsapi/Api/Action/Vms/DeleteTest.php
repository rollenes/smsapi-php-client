<?php

namespace SMSApi\Api\Action\Vms;

use SMSApi\Api\Response\CountableResponse;
use SMSApi\Client;

class DeleteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Delete
     */
    private $deleteVmsAction;

    protected function setUp()
    {
        $deleteVmsAction = new Delete();

        $proxy = $this->getMock('\SMSApi\Proxy\Http\Native', array(), ['']);

        $proxy->expects($this->any())
            ->method('execute')
            ->will($this->returnValue('{}'));

        $deleteVmsAction->client(new Client('test'));
        $deleteVmsAction->proxy($proxy);

        $this->deleteVmsAction = $deleteVmsAction;
    }

    public function testPrepareQueryWithNoFilter()
    {
        $query = $this->deleteVmsAction->prepareQuery();

        $this->assertEquals('username=test&password=&sch_del=', $query);
    }

    public function testPrepareQueryWithOneIdFilter()
    {
        $this->deleteVmsAction->filterByIds(['deleteId']);

        $query = $this->deleteVmsAction->prepareQuery();

        $this->assertEquals('username=test&password=&sch_del=deleteId', $query);
    }

    public function testPrepareQueryWithManyIdFilter()
    {
        $this->deleteVmsAction->filterByIds(['del1', 'del2', 'del3']);

        $query = $this->deleteVmsAction->prepareQuery();

        $this->assertEquals('username=test&password=&sch_del=del1,del2,del3', $query);
    }

    public function testExecute()
    {
        $result = $this->deleteVmsAction->execute();

        $this->assertInstanceOf('SMSApi\Api\Response\CountableResponse', $result);
        $this->assertSame(0, $result->getCount());
    }
}
