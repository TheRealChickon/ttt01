<?php

class Player
{
    private string $nickname;
    private string $token;

    public function getName(): string
    {
        return $this->nickname;
    }

    public function setName(string $name): void
    {
        $this->nickname = $name;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}