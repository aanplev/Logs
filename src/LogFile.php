<?php

namespace Logs;

(new LogFile)->setDirectory('/var/www/dealer-car.ru/data/www/upgrade2.dealer-car.ru/system/logs/')
	->setFilename(date('Y-m-d'))
	->setMessage('Error')
	->setMessage('Weew')
	->write();

class LogFile
{
	private $directory;
	private $filename;
	private $message;

	public function setDirectory(string $directory = '') : LogFile
	{
		$this->directoryConstruct($directory);
		$this->directory = $this->folderPathTransform($directory);

		return $this;
	}

	private function directoryConstruct(string $data) : void
	{
		$directories = array_filter(explode('/', $data));
		$current     = '';

		foreach ($directories as $directory) {
			$current .= '/' . $directory;

			if (!file_exists($current)) {
				@mkdir($current, 0777);
			}
		}
	}

	private function folderPathTransform(string $directory) : string
	{
		if (mb_substr($directory, 0, 1) !== '/') {
			$directory = '/' . $directory;
		}

		if (mb_substr($directory, -1) !== '/') {
			$directory = $directory . '/';
		}

		return $directory;
	}

	public function setFilename(string $filename = 'newLog') : LogFile
	{
		$this->filename = $filename;

		return $this;
	}

	public function setMessage(string $message = '') : LogFile
	{
		$this->message .= date('Y-m-d H:i:s') . ' ' . $message . PHP_EOL;

		return $this;
	}

	public function write() : void
	{
		file_put_contents($this->directory . $this->filename . '.log', $this->message, FILE_APPEND | LOCK_EX);
	}
}
