<?php

namespace SMSApi\Api\Action\Phonebook;

use SMSApi\Api\Action\AbstractAction;

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
}

