<?php

namespace SMSApi\Api\Action\Phonebook;

use SMSApi\Api\Action\AbstractAction;
use SMSApi\Proxy\Uri;

/**
 * Class ContactDelete
 * @package SMSApi\Api\Action\Phonebook
 */
class ContactDelete extends AbstractAction
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
	 * Set contact phone number to delete.
	 *
	 * @param string|int $number phone number
	 * @return $this
	 */
	public function filterByPhoneNumber( $number ) {
		$this->params[ "delete_contact" ] = $number;
		return $this;
	}

	/**
	 * @deprecated since v1.0.0
	 * @param string|int $number phone number
	 * @return $this
	 */
	public function setContact($number) {
		return $this->filterByPhoneNumber($number);
	}

}

