<?php

namespace backAlda\Src\Models;

use PDO;

class Model
{
    public $conexaoPdo;

    public function __construct()
    {
        $this->conexaoPdo = new PDO('mysql://root:uDxjAgAHR0ra02yG4BdK@containers-us-west-73.railway.app:7230/railway);
    }
}
