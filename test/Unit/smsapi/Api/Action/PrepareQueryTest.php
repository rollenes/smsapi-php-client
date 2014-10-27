<?php

namespace SMSApi\Api\Action;

use SMSApi\Client;
use SMSApi\Proxy\Http\Native;

class PrepareQueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider actionProvider
     */
    public function testPrepareQueryDummy(AbstractAction $action, $query)
    {
        $this->assertEquals($query, $action->uri()->getQuery());
    }

    public function actionProvider()
    {
        return array(

            array($this->configureAction(new Mms\Delete()), 'username=test&password=&sch_del='),
            array($this->configureAction(new Mms\Get()), 'username=test&password=&status='),
            array($this->configureAction(new Mms\Send()), 'username=test&password=&to='),

            array($this->configureAction(new Phonebook\ContactAdd()), 'username=test&password=&groups='),
            array($this->configureAction(new Phonebook\ContactDelete()), 'username=test&password='),
            array($this->configureAction(new Phonebook\ContactEdit()), 'username=test&password=&groups='),
            array($this->configureAction(new Phonebook\ContactGet()), 'username=test&password='),
            array($this->configureAction(new Phonebook\ContactList()), 'username=test&password=&groups=&list_contacts=1'),

            array($this->configureAction(new Phonebook\GroupAdd()), 'username=test&password='),
            array($this->configureAction(new Phonebook\GroupDelete()), 'username=test&password='),
            array($this->configureAction(new Phonebook\GroupEdit()), 'username=test&password='),
            array($this->configureAction(new Phonebook\GroupGet()), 'username=test&password='),
            array($this->configureAction(new Phonebook\GroupList()), 'username=test&password=&list_groups=1'),

            array($this->configureAction(new Sender\Add()), 'username=test&password='),
            array($this->configureAction(new Sender\Delete()), 'username=test&password='),
            array($this->configureAction(new Sender\SenderDefault()), 'username=test&password='),
            array($this->configureAction(new Sender\SenderList()), 'username=test&password=&list=1'),

            array($this->configureAction(new Sms\Delete()), 'username=test&password=&sch_del='),
            array($this->configureAction(new Sms\Get()), 'username=test&password=&status='),
            array($this->configureAction(new Sms\Send()), 'username=test&password=&to=&encoding=utf-8'),

            array($this->configureAction(new User\Add()), 'username=test&password='),
            array($this->configureAction(new User\Edit()), 'username=test&password='),
            array($this->configureAction(new User\Get()), 'username=test&password='),
            array($this->configureAction(new User\GetPoints()), 'username=test&password=&credits=1'),
            array($this->configureAction(new User\UserList()), 'username=test&password=&list=1'),

            array($this->configureAction(new Vms\Delete()), 'username=test&password=&sch_del='),
            array($this->configureAction(new Vms\Get()), 'username=test&password=&status='),
            array($this->configureAction(new Vms\Send()), 'username=test&password=&to='),
        );
    }

    private function configureAction(AbstractAction $action)
    {
        $action->client(new Client('test'));
        $action->proxy(new Native('http://example.com'));

        return $action;
    }
}