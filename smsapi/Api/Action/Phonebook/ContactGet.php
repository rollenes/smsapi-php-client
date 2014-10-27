<?php

namespace SMSApi\Api\Action\Phonebook;

use SMSApi\Api\Action\AbstractAction;
use SMSApi\Proxy\Uri;

/**
 * Class ContactGet
 * @package SMSApi\Api\Action\Phonebook
 */
class ContactGet extends AbstractAction
{
    /**
	 * @param $data
	 * @return \SMSApi\Api\Response\ContactResponse
	 */
	protected function response( $data ) {

		return new \SMSApi\Api\Response\ContactResponse( $data );
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

        $this->withGroups();
        
        $query .= $this->paramsLoginToQuery();

        $query .= $this->paramsOther();

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

	/**
	 * @deprecated since v1.0.0
	 */
	public function setContact( $number ) {
		return $this->filterByPhoneNumber( $number );
	}

	/**
	 * Set filter by contact phone number.
	 *
	 * @param string|int $number phone number
	 * @return $this
	 */
	public function filterByPhoneNumber( $number ) {
		$this->params[ "get_contact" ] = $number;
		return $this;
	}


	/**
	 * Add contact groups to response
	 *
	 * @return $this
	 */
	private function withGroups() {
		$this->params[ "with_groups" ] = 1;
		return $this;
	}

}