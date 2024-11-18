<?php

class deletebook_model
{
    protected Database $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }


}