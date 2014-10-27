<?php

namespace SMSApi\Api\Action\Sender;

use SMSApi\Api\Action\AbstractAction;

/**
 * Class SenderList
 * @package SMSApi\Api\Action\Sender
 */
class SenderList extends AbstractAction
{
    /**
	 * @param $data
	 * @return \SMSApi\Api\Response\SendersResponse
	 */
	protected function response( $data ) {

		return new \SMSApi\Api\Response\SendersResponse( $data );
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

        $query .= "&list=1";

        return $query;
    }
}

