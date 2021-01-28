<?php

namespace Logs;

interface LogInterface
{
	/**
	 * Save a new log.
	 */
	public function write() : void;
}
