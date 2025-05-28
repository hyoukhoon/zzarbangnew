<?php

namespace App\Models;

use PDPhilip\Elasticsearch\Eloquent\Model;


class Ozzal extends Model
{

    protected $connection = 'elasticsearch';
    protected $table = 'ozzal';
    protected $indexName = 'ozzal';

    protected $dates = [
        'site_reg_date'
    ];

    protected $dateFormat = 'Y/m/d H:i:s';

    public $timestamps = false;
}

?>