<?php

namespace SMSApi\Api\Action\Mms;

use SMSApi\Api\Action\AbstractAction;

/**
 * Class Get
 * @package SMSApi\Api\Action\Mms
 */
class Get extends AbstractAction {

	/**
	 * @var \ArrayObject
	 */
	private $id;

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
        return "/api/mms.do";
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
	 * Set ID of messages to check.
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
	 * @param $ids
	 * @return $this
	 * @throws \SMSApi\Exception\ActionException
	 */
	public function filterByIds( array $ids ) {

		$this->id->exchangeArray( $ids );
		return $this;
	}

	/**
	 * @deprecated since v1.0.0
	 */
	public function ids($array) {
		return $this->filterByIds($array);
	}

	/**
	 * @deprecated since v1.0.0
	 */
	public function id($id) {
		return $this->filterById($id);
	}

}

