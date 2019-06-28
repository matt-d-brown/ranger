<?php

namespace Grizzlyware\Ranger\Examples\Client;

use Grizzlyware\Ranger\Client\Context;
use Grizzlyware\Ranger\Server\License\ValidationResult;

class License extends \Grizzlyware\Ranger\Client\License
{
	protected $licenseKey;

	public function fetchFingerprint()
	{
		return null;
	}

	public function storeFingerprint()
	{
		// TODO: Implement storeFingerprint() method.
	}

	public function validateForContext(Context $context)
	{
		$result = new ValidationResult();
		$result->valid = strpos($this->licenseKey, "Two222Two222Two") === false; // Two license is found but invalid
		return $result;
	}

	public function setKey($licenseKey)
	{
		$this->licenseKey = $licenseKey;
	}

	public static function formWithString($licenseKey)
	{
		$license = new self();
		$license->setKey($licenseKey);
		return $license;
	}

	public function pack()
	{
		return json_encode(['licenseKey' => $this->licenseKey]);
	}

	public static function unpack($body)
	{
		// Decode
		$body = json_decode($body);

		// Reconstruct it
		$license = new self();

		// Set the props
		$license->setKey($body->licenseKey);

		return $license;
	}
}



