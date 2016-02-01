<?php

namespace Learner\Repositories\Table;

use DB;

abstract class AbstractTableRepository
{
    /**
     * Table name
     *
     * @var string
     */
    protected $tableName;

    /**
     * Table instance
     *
     * @var \Illuminate\Database\DatabaseManager
     */
    protected $table;

    public function __construct()
    {
        $this->table = DB::table($this->tableName);
    }
}
