<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
#use \Illuminate\Support\Facades\DB;

class Audit extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string The name of the table
     */
    protected $table = 'audit';
}
