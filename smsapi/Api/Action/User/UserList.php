<?php

namespace SMSApi\Api\Action\User;

use SMSApi\Api\Action\AbstractAction;

/**
 * Class UserList
 * @package SMSApi\Api\Action\User
 */
class UserList extends AbstractAction
{

    /**
	 * @param $data
	 * @return \SMSApi\Api\Response\UsersResponse
	 */
	protected function response( $data ) {

		return new \SMSApi\Api\Response\UsersResponse( $data );
	}

    /**
     * @return string
     */
    public function getPath()
    {
        return "/api/user.do";
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
