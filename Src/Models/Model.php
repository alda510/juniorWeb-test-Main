<?php

namespace backAlda\Src\Models;

use PDO;

class Model
{
    public $conexaoPdo;

    public function __construct()
    {
        $this->conexaoPdo = new PDO('mysql:host=localhost;dbname=mvc', 'root', '');
    }
}