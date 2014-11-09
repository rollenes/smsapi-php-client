<?php

require_once 'SmsapiTestCase.php';

class VmsTest extends SmsapiTestCase
{

	private $error = 0;
	private $ids = array( );

	public function testSendAudio()
    {
		$this->sendAudioFile();

		$this->sendAudioTts();


		$this->writeIds( $this->ids );

		$this->assertEquals( 0, $this->error );
	}

	private function sendAudioFile()
    {
		$smsApi = new \SMSApi\Api\VmsFactory( null, $this->client() );

		$result = null;

        $time = $this->prepareTimeToSend();

		$audio_file = __DIR__ . DIRECTORY_SEPARATOR . "voice_small.wav";

		$action = $smsApi->actionSend();

		/* @var $result \SMSApi\Api\Response\StatusResponse */
		/* @var $item \SMSApi\Api\Response\MessageResponse */

		$result =
            $action->setFile($audio_file)
                ->setTo($this->getNumberTest())
                ->setDateSent($time)
                ->execute();

		echo "VmsSendFile:\n";

		foreach ( $result->getList() as $item ) {
			if ( !$item->getError() ) {
				$this->renderMessageItem( $item );
				$this->ids[ ] = $item->getId();
			} else {
				$this->error++;
			}
		}
	}

	public function sendAudioTts()
    {
		$smsApi = new \SMSApi\Api\VmsFactory( null, $this->client() );

		$result = null;

		$time = $this->prepareTimeToSend();

		$tts = "Wiadomość w formacie TTS";

		$action = $smsApi->actionSend();

		/* @var $result \SMSApi\Api\Response\StatusResponse */
		/* @var $item \SMSApi\Api\Response\MessageResponse */

		$result = $action->setTts($tts)
			->setTo($this->getNumberTest())
			->setDateSent($time)
			->setTtsLector(\SMSApi\Api\Action\Vms\Send::LECTOR_JACEK)
			->execute();

		echo "VmsSendTts:\n";

		foreach ( $result->getList() as $item ) {
			if ( !$item->getError() ) {
				$this->renderMessageItem( $item );
				$this->ids[ ] = $item->getId();
			} else {
				$this->error++;
			}
		}
	}

    /**
     * @depends testSendAudioFile
     * @depends testSendAudioTts
     */
    public function testGet($audioIds, $ttsIds)
    {
		$smsApi = new \SMSApi\Api\VmsFactory( null, $this->client() );

		$action = $smsApi->actionGet();

		$ids = array_merge($audioIds, $ttsIds);

		/* @var $result \SMSApi\Api\Response\StatusResponse */

		$result = $action->filterByIds($ids)->execute();

		echo "\nVmsGet:\n";

        $this->renderStatusResponse($result);

        $errorCount = $this->countErrors($result);

		$this->assertEquals(0, $errorCount);
        $this->assertEquals(2, $result->getCount());
	}

	public function testDelete()
    {
		$smsApi = new \SMSApi\Api\VmsFactory( null, $this->client() );

		$result = null;

		$action = $smsApi->actionDelete();

		$ids = $this->readIds();

		/* @var $result \SMSApi\Api\Response\CountableResponse */

		$result = $action->filterByIds($ids)->execute();

		echo "\nMmsDelete:\n";
		echo "Delete: " . $result->getCount();

		$this->assertEquals( 2, $result->getCount() );
	}

    /**
     * @return int
     */
    private function prepareTimeToSend()
    {
        $dateSent = new DateTime('+1 day', new DateTimeZone('Europe/Warsaw'));
        $dateSent->setTime(14, 0);

        $time = $dateSent->getTimestamp();
        return $time;
    }

}

