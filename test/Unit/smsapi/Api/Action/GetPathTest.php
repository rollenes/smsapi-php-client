<?php

namespace SMSApi\Api\Action;

use SMSApi\Client;
use SMSApi\Proxy\Http\Native;

class GetPathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider actionProvider
     */
    public function testGetPath(AbstractAction $action, $path)
    {
        $this->assertEquals($path, $action->uri()->getPath());
        $this->assertEquals($path, $action->getPath());
    }

    public function actionProvider()
    {
        return array(

            array($this->configureAction(new Mms\Delete()), '/api/mms.do'),
            array($this->configureAction(new Mms\Get()), '/api/mms.do'),
            array($this->configureAction(new Mms\Send()), '/api/mms.do'),

            array($this->configureAction(new Phonebook\ContactAdd()), '/api/phonebook.do'),
            array($this->configureAction(new Phonebook\ContactDelete()), '/api/phonebook.do'),
            array($this->configureAction(new Phonebook\ContactEdit()), '/api/phonebook.do'),
            array($this->configureAction(new Phonebook\ContactGet()), '/api/phonebook.do'),
            array($this->configureAction(new Phonebook\ContactList()), '/api/phonebook.do'),

            array($this->configureAction(new Phonebook\GroupAdd()), '/api/phonebook.do'),
            array($this->configureAction(new Phonebook\GroupDelete()), '/api/phonebook.do'),
            array($this->configureAction(new Phonebook\GroupEdit()), '/api/phonebook.do'),
            array($this->configureAction(new Phonebook\GroupGet()), '/api/phonebook.do'),
            array($this->configureAction(new Phonebook\GroupList()), '/api/phonebook.do'),

            array($this->configureAction(new Sender\Add()), '/api/sender.do'),
            array($this->configureAction(new Sender\Delete()), '/api/sender.do'),
            array($this->configureAction(new Sender\SenderDefault()), '/api/sender.do'),
            array($this->configureAction(new Sender\SenderList()), '/api/sender.do'),

            array($this->configureAction(new Sms\Delete()), '/api/sms.do'),
            array($this->configureAction(new Sms\Get()), '/api/sms.do'),
            array($this->configureAction(new Sms\Send()), '/api/sms.do'),

            array($this->configureAction(new User\Add()), '/api/user.do'),
            array($this->configureAction(new User\Edit()), '/api/user.do'),
            array($this->configureAction(new User\Get()), '/api/user.do'),
            array($this->configureAction(new User\GetPoints()), '/api/user.do'),
            array($this->configureAction(new User\UserList()), '/api/user.do'),

            array($this->configureAction(new Vms\Delete()), '/api/vms.do'),
            array($this->configureAction(new Vms\Get()), '/api/vms.do'),
            array($this->configureAction(new Vms\Send()), '/api/vms.do'),
        );
    }

    private function configureAction(AbstractAction $action)
    {
        $action->client(new Client('username'));
        $action->proxy(new Native('http://example.com'));

        return $action;
    }
}