<?php

namespace SMSApi\Api\Action\User;

use SMSApi\Api\Action\AbstractAction;

/**
 * Class Get
 * @package SMSApi\Api\Action\User
 */
class Get extends AbstractAction
{
    /**
	 * @param $data
	 * @return \SMSApi\Api\Response\UserResponse
	 */
	protected function response( $data ) {

		return new \SMSApi\Api\Response\UserResponse( $data );
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

        return $query;
    }

	/**
	 * @deprecated since v1.0.0
	 * @param $username
	 * @return $this
	 */
	public function setUsername( $username ) {
		$this->params[ "get_user" ] = $username;
		return $this;
	}

	/**
	 * Set username to edit account.
	 *
	 * @param string $username username
	 * @return $this
	 */
	public function filterByUserName( $username ) {
		$this->params[ "get_user" ] = $username;
		return $this;
	}

}

