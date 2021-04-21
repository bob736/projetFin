<?php

namespace App\Traits;

use App\Classes\DB;
use PDO;

trait Manager
{
    private ?PDO $db;

    /**
     * ArticleManager constructor.
     */
    public function __construct()
    {
        $this->db = DB::getInstance();
    }

}