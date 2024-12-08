<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SchemaService
{
    public function getSchemas(): array
    {
        $tables = DB::select('SHOW TABLES');
        $schemas = [];

        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            $columns = DB::select("DESCRIBE $tableName");
            $schemas[$tableName] = array_column($columns, 'Field');
        }

        return $schemas;
    }
}
