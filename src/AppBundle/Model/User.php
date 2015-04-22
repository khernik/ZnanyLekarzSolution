<?php

namespace AppBundle\Model;

class User
{
	protected $id, $name, $email;

	function __construct($id, $name, $email)
	{
		$this->id    = $id;
		$this->name  = $name;
		$this->email = $email;
	}

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
}
