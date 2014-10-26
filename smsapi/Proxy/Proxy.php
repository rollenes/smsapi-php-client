<?php

namespace SMSApi\Proxy;

use SMSApi\Api\Action\AbstractAction;

interface Proxy
{
    public function execute(AbstractAction $action);

    public function getProtocol();

    public function getHost();

    public function getPort();

    /**
     * @return Uri
     */
    public function createUri();
}