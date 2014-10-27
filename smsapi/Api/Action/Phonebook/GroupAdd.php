<?php

namespace SMSApi\Api\Action\Phonebook;

use SMSApi\Api\Action\AbstractAction;

/**
 * Class GroupAdd
 * @package SMSApi\Api\Action\Phonebook
 */
class GroupAdd extends AbstractAction
{
    /**
	 * @param $data
	 * @return \SMSApi\Api\Response\GroupResponse
	 */
	protected function response( $data ) {

		return new \SMSApi\Api\Response\GroupResponse( $data );
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

        return $query;
    }

	/**
	 * Set group name.
	 *
	 * @param string $groupName
	 * @return $this
	 */
	public function setName( $groupName ) {
		$this->params[ "add_group" ] = $groupName;
		return $this;
	}

	/**
	 * Set additional group description.
	 *
	 * @param string $info group description
	 * @return $this
	 */
	public function setInfo( $info ) {
		$this->params[ "info" ] = $info;
		return $this;
	}

}

