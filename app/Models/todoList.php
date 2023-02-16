<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todoList extends Model
{
    use HasFactory;
    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $timestamps = true;

    public $userstamps = true;

    protected $guarded = [];
}
