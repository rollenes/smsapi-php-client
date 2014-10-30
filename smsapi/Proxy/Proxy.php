<?php

namespace SMSApi\Proxy;

use SMSApi\Api\Action\AbstractAction;

interface Proxy
{
    public function execute(AbstractAction $action);

    /**
     * @deprecated since version 1.2
     */
    public function getProtocol();

    /**
     * @deprecated since version 1.2
     */
    public function getHost();

    /**
     * @deprecated since version 1.2
     */
    public function getPort();

    /**
     *
     * @return Uri
     */
    public function createUri($query, $path);
}