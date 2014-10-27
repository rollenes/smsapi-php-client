<?php

namespace SMSApi\Api\Action\Sender;

use SMSApi\Api\Action\AbstractAction;

/**
 * Class SenderDefault
 * @package SMSApi\Api\Action\Sender
 */
class SenderDefault extends AbstractAction
{
    /**
	 * @param $data
	 * @return \SMSApi\Api\Response\RawResponse
	 */
	protected function response( $data ) {

		return new \SMSApi\Api\Response\RawResponse( $data );
	}

    /**
     * @return string
     */
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
	 * Set name of default sender name.
	 *
	 * @param string $senderName sender name
	 * @return $this
	 */
	public function setSender( $senderName ) {
		$this->params[ "default" ] = $senderName;
		return $this;
	}

}

