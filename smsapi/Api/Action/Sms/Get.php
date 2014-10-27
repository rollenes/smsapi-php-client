<?php

namespace SMSApi\Api\Action\Sms;

use SMSApi\Api\Action\AbstractAction;
use SMSApi\Proxy\Uri;

/**
 * Class Get
 *
 * @package SMSApi\Api\Action\Sms
 */
class Get extends AbstractAction
{
	/**
	 * @var \ArrayObject
	 */
	private $id;

	/**
	 *
	 */
	function __construct() {
		$this->id = new \ArrayObject();
	}

    /**
	 * @param $data
	 * @return \SMSApi\Api\Response\StatusResponse
	 */
	protected function response( $data ) {

		return new \SMSApi\Api\Response\StatusResponse( $data );
	}

    /**
     * @return string
     */
    public function getPath()
    {
        return "/api/sms.do";
    }

    /**
     * @return string
     */
    public function prepareQuery()
    {
        $query = "";

        $query .= $this->paramsLoginToQuery();

        $query .= $this->paramsOther();

        $query .= "&status=" . implode("|", $this->id->getArrayCopy());

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
	 * Set ID of message to check.
	 *
	 * This id was returned after sending message.
	 *
	 * @param $id
	 * @return $this
	 * @throws \SMSApi\Exception\ActionException
	 */
	public function filterById( $id ) {
		$this->id->append( $id );
		return $this;
	}

	/**
	 * Set IDs of messages to check.
	 *
	 * This id was returned after sending message.
	 *
	 * @param array $ids Message ids
	 * @return $this
	 */
	public function filterByIds( array $ids ) {
		$this->id->exchangeArray( $ids );
		return $this;
	}

	/**
	 * @deprecated since v1.0.0
	 * @param array $ids
	 * @return $this
	 */
	public function ids( array $ids ) {
		return $this->filterByIds( $ids );
	}

	/**
	 * @deprecated since v1.0.0
	 * @param $id
	 * @return $this
	 */
	public function id( $id ) {
		return $this->filterById($id);
	}

}
