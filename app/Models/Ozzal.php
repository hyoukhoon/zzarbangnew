<?php

namespace App\Models;

use PDPhilip\Elasticsearch\Eloquent\Model;

class Ozzal extends Model
{
    protected $connection = 'elasticsearch';
    protected $table = 'ozzal';

}

?>