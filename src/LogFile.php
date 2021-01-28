<?php

namespace Logs;

/**
 * Class LogFile
 *
 * @package Logs
 * @property string $directory
 * @property string $filename
 * @property string $message
 */

class LogFile implements LogInterface
{
	private $directory;
	private $filename;
	private $message;

	/**
	 * Set the directory for saving the log.
	 *
	 * @param string $directory
	 *
	 * @return $this
	 */
	public function setDirectory(string $directory = '') : LogFile
	{
		$this->directoryConstruct($directory);
		$this->directory = $this->folderPathTransform($directory);

		return $this;
	}

	/**
	 * Checking for the existence of directories and creating if they don't exist.
	 *
	 * @param string $data
	 */
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

	/**
	 * File path conversion.
	 *
	 * @param string $directory
	 *
	 * @return string
	 */
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


	/**
	 * Set the name of the log file.
	 *
	 * @param string $filename
	 *
	 * @return $this
	 */
	public function setFilename(string $filename = 'newLog') : LogFile
	{
		$this->filename = $filename;

		return $this;
	}

	/**
	 * Set message in the log file.
	 *
	 * @param string $message
	 *
	 * @return $this
	 */
	public function setMessage(string $message = '') : LogFile
	{
		$this->message .= date('Y-m-d H:i:s') . ' ' . $message . PHP_EOL;

		return $this;
	}

	/**
	 * Save a new log.
	 */
	public function write() : void
	{
		file_put_contents($this->directory . $this->filename . '.log', $this->message, FILE_APPEND | LOCK_EX);
	}
}
