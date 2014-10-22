SMSAPI PHP client - version 2.0 - proposal
==========================================

Introduction
------------

Currently  SMSAPI PHP client library is too much complicated. To send simple SMS message you have to write something like:

    $client = new \SMSApi\Client('login');
    $client->setPasswordHash(md5('super tajne haslo'));

    $smsapi = new \SMSApi\Api\SmsFactory();
    $smsapi->setClient($client);

    $actionSend = $smsapi->actionSend();

    $actionSend->setTo('600xxxxxx');
    $actionSend->setText('Hello World!!');
    $actionSend->setSender('SMSAPI.pl');

    $response = $actionSend->execute();

What is in that code:

1. The Client class object is created with 'login' parameter
2. Password hash is passed to Client::setPasswordHash method
3. SmsFactory kind of factory is created
4. Than Client is passed to that factory - (if we do not pass this parameter every call to to actionXXX method will fail)
5. The SmsFactory::actionSend is called and it creates SmsSendAction object
6. Than we call another methods on SmsSendAction object to inject parameters to this action
7. After we prepare SmsSendAction object we call execute on it, and as a result we got some kind of Response object
8. Then we have to guess what type of action we executed, and what type of result we get to perform other actions on response - there is no simple way to get it by definition because of fact, that execute method is defined in AbstractAction class

So to use this API is rather complicated for developers, that do not know internal structure of library.

It would be much more friendly if it looked like:

    $smsapiClient = new SmsapiClient('login', 'password');

    $sms = new SMS();
    $sms->setRecipient('600xxxxxx');
    $sms->setText('Hello World!!');
    $sms->setSender('SMSAPI.pl');

    $response = $smsapiClient->sendSms($sms);

In this example:

1. We create SmsapiClient object with required parameters (login, password)
2. We create object that is representation of SMS
3. We call some setters on SMS object
4. We call SmsapiClient::sendSms method with SMS parameter and we got SmsResponse

It is much more simple, and it gives developer just what he needs without digging in internal structure of library.
