<?php

namespace Logs;

use GuzzleHttp\Client;

class LogTg
{
	private $botId;
	private $token;
	private $chatId;
	private $message;

	public function setBotId(int $botId) : LogTg
	{
		$this->botId = $botId;

		return $this;
	}

	public function setToken(string $token) : LogTg
	{
		$this->token = $token;

		return $this;
	}

	public function setChatId(int $chatId) : LogTg
	{
		$this->chatId = $chatId;

		return $this;
	}

	public function setMessage(string $message = '') : LogTg
	{
		$this->message .= date('Y-m-d H:i:s') . ' ' . $message . PHP_EOL;

		return $this;
	}

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
