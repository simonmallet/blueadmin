<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
#use \Illuminate\Support\Facades\DB;

class Client extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'uid';

    /**
     * @var string The name of the table
     */
    protected $table = 'clients';
}
