<?php

namespace SMSApi\Api\Action\Sms;

use SMSApi\Api\Action\AbstractAction;
use SMSApi\Proxy\Uri;

/**
 * Class Delete
 * @package SMSApi\Api\Action\Sms
 */
class Delete extends AbstractAction {

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
	 * @return \SMSApi\Api\Response\CountableResponse
	 */
	protected function response( $data ) {

		return new \SMSApi\Api\Response\CountableResponse( $data );
	}

    public function getPath()
    {
        return "/api/sms.do";
    }

	/**
	 * @return Uri
	 */
	public function uri() {

		$query = "";

		$query .= $this->paramsLoginToQuery();

		$query .= $this->paramsOther();

		$query .= "&sch_del=" . implode( "|", $this->id->getArrayCopy() );

		return new Uri( $this->proxy->getProtocol(), $this->proxy->getHost(), $this->proxy->getPort(), "/api/sms.do", $query );
	}


	/**
	 * Set ID of message to delete.
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
	 * Set IDs of messages to delete.
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
	 *
	 * @param $id
	 * @return $this
	 */
	public function id( $id ) {
		return $this->filterById($id);
	}

}

