<?php

namespace SMSApi\Api\Action\Sender;

use SMSApi\Api\Action\AbstractAction;
use SMSApi\Proxy\Uri;

/**
 * Class Add
 * @package SMSApi\Api\Action\Sender
 */
class Add extends AbstractAction
{
    /**
	 * @param $data
	 * @return \SMSApi\Api\Response\CountableResponse
	 */
	protected function response( $data ) {

		return new \SMSApi\Api\Response\CountableResponse( $data );
	}

    public function getPath()
    {
        return "/api/sender.do";
    }

    /**
     * @return string
     */
    public function prepareQuery()
    {
        $query = "";

        $query .= $this->paramsLoginToQuery();

        $query .= $this->paramsOther();

        return $query;
    }

	/**
	 * @return Uri
	 */
	public function uri()
    {
        $query = $this->prepareQuery();

		return new Uri( $this->proxy->getProtocol(), $this->proxy->getHost(), $this->proxy->getPort(), "/api/sender.do", $query );
	}

	/**
	 * Set new sender name.
	 *
	 * @param string $senderName sender name
	 * @return $this
	 */
	public function setName( $senderName ) {
		$this->params[ "add" ] = $senderName;
		return $this;
	}

}

