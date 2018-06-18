<?php

namespace app\Models;

class User
{
    private $name;
    private $email;
    private $password;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(
                __METHOD__ . " expects valid email address.",
                400
            );
        }

        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        if (strlen($password) < 8) {
            throw new \InvalidArgumentException(
                __METHOD__ . " expects password to be at least 8 characters long.",
                400
            );
        }

        $this->password = $password;
    }
}