<?php

namespace SMSApi\Api\Action\Phonebook;

use SMSApi\Api\Action\AbstractAction;
use SMSApi\Proxy\Uri;

/**
 * Class GroupList
 * @package SMSApi\Api\Action\Phonebook
 */
class GroupList extends AbstractAction
{
    /**
	 * @param $data
	 * @return \SMSApi\Api\Response\GroupsResponse
	 */
	protected function response( $data ) {

		return new \SMSApi\Api\Response\GroupsResponse( $data );
	}

    public function getPath()
    {
        return "/api/phonebook.do";
    }

    /**
     * @return string
     */
    public function prepareQuery()
    {
        $query = "";

        $query .= $this->paramsLoginToQuery();

        $query .= $this->paramsOther();

        $query .= "&list_groups=1";

        return $query;
    }

    /**
	 * @return Uri
	 */
	public function uri() {

        $query = $this->prepareQuery();

		return new Uri( $this->proxy->getProtocol(), $this->proxy->getHost(), $this->proxy->getPort(), "/api/phonebook.do", $query );
	}

}

