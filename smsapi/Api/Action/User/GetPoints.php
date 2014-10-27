<?php

namespace SMSApi\Api\Action\User;

use SMSApi\Api\Action\AbstractAction;
use SMSApi\Proxy\Uri;

/**
 * Class GetPoints
 *
 * @package SMSApi\Api\Action\User
 *
 * @method \SMSApi\Api\Response\PointsResponse|null execute() execute()
 */
class GetPoints extends AbstractAction
{
    /**
	 * @param $data
	 * @return \SMSApi\Api\Response\PointsResponse
	 */
	protected function response( $data ) {

		return new \SMSApi\Api\Response\PointsResponse( $data );
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

        $query .= "&credits=1";

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

}

