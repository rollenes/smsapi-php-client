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

    /**
     * @return string
     */
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
	public function uri()
    {
        $path = $this->getPath();
        $query = $this->prepareQuery();

		return new Uri(
            $this->proxy->getProtocol(),
            $this->proxy->getHost(),
            $this->proxy->getPort(),
            $path,
            $query
        );
	}

}

