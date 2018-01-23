<?php

class constructorChallenge {

private $nonsenseString;
private $number;

	public function __construct($newNonsenseString, $newNumber) {
		try {
			$this->setNonsenseString($newNonsenseString);
			$this->setNumber($newNumber);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	public function getNonsenseString(): string {
		return ($this->nonsenseString);
	}

	public function setNonsenseString(string $newNonsenseString): void {
		// verify the article title is secure
		$newNonsenseString = trim($newNonsenseString);
		$newNonsenseString = filter_var($newNonsenseString, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newNonsenseString) === true) {
			throw(new \InvalidArgumentException("String is empty or insecure"));
		}
		// verify the article title will fit in the database
		if(strlen($newNonsenseString) > 64) {
			throw(new \RangeException("String too long"));
		}
		// store the article title
		$this->nonsenseString = $newNonsenseString;
	}

	public function getNumber(): int {
		return ($this->number);
	}

	public function setNumber(int $newNumber) : void {
		if(is_int($newNumber) === false) {
			throw(new \InvalidArgumentException("Not an integer"));
		}
		$this->number = $newNumber;
	}



}

$totallyRandom = new constructorChallenge("today we fight!", 300);

