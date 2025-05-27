<?php

namespace App\Models;

use PDPhilip\Elasticsearch\Eloquent\Model;

class Chukppa extends Model
{
    protected $connection = 'elasticsearch';
    protected $table = 'chukppa';
}

?>