<?php

namespace Logs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class LogTelegram
 *
 * @package Logs
 * @property integer $botId
 * @property string  $token
 * @property integer $chatId
 * @property string  $message
 */
class LogTelegram implements LogInterface
{
	private $botId;
	private $token;
	private $chatId;
	private $message;

	/**
	 * Set the bot id value.
	 *
	 * @param int $botId
	 *
	 * @return $this
	 */
	public function setBotId(int $botId) : LogTelegram
	{
		$this->botId = $botId;

		return $this;
	}

	/**
	 * Set the token.
	 *
	 * @param string $token
	 *
	 * @return $this
	 */
	public function setToken(string $token) : LogTelegram
	{
		$this->token = $token;

		return $this;
	}

	/**
	 * Set the chat id value.
	 *
	 * @param int $chatId
	 *
	 * @return $this
	 */
	public function setChatId(int $chatId) : LogTelegram
	{
		$this->chatId = $chatId;

		return $this;
	}

	/**
	 * Set message in the Telegram message.
	 *
	 * @param string $message
	 *
	 * @return $this
	 */
	public function setMessage(string $message = '') : LogTelegram
	{
		$this->message .= date('Y-m-d H:i:s') . ' ' . $message . PHP_EOL;

		return $this;
	}

	/**
	 * Save a new log.
	 *
	 * @throws GuzzleException
	 */
	public function write() : void
	{
		(new Client)->post(
			'https://api.telegram.org/bot' . $this->botId . ':' . $this->token . '/sendMessage',
			[
				'form_params' => [
					'chat_id' => $this->chatId,
					'text'    => $this->message,
				],
			]
		);
	}
}
