<?php

namespace SMSApi\Api\Action\Mms;

use SMSApi\Api\Action\AbstractAction;

/**
 * Class Delete
 * @package SMSApi\Api\Action\Mms
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

        $query .= "&sch_del=" . implode("|", $this->id->getArrayCopy());

        return $query;
    }

	/**
	 * Set ID of messages to delete.
	 *
	 * This id was returned after sending message.
	 *
	 * @param $id
	 * @return $this
	 * @throws \SMSApi\Exception\ActionException
	 */
	public function filterById( $id ) {
		if ( !is_string( $id ) ) {
			throw new \SMSApi\Exception\ActionException( 'Invalid value id' );
		}

		$this->id->append( $id );
		return $this;
	}

	/**
	 *
	 * Set array IDs of messages to delete.
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

