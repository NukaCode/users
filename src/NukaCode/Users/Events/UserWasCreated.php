<?php namespace NukaCode\Users\Events;

class UserWasCreated {

	public $user;

	function __construct($user)
	{
		$this->user = $user;
	}

} 