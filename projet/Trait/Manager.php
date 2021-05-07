<?php

namespace App\Traits;

use PDO;
use App\Classes\DB;

trait GlobalManager
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