<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Todo extends model
{
    //
    public static function insertToTask($a)
    {
    	\Log::info('**********........Todo MODEL.................insertToTask function');

      
        DB::insert('insert into tasks (user_id, name, created_at, updated_at) '.
            'values (?, ? , ?, ?)', [6, $a,'now()', 'now()']);
    }
}
