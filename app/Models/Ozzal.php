<?php

namespace App\Models;

use PDPhilip\Elasticsearch\Eloquent\Model;
use pdphilip\elasticsearch\ElasticquentTrait;

class Ozzal extends Model
{

    use ElasticquentTrait;
    protected $indexName = 'ozzal';

    protected $connection = 'elasticsearch';
    protected $table = 'ozzal';

    protected $dates = [
        'site_reg_date'
    ];

    protected $dateFormat = 'Y/m/d H:i:s';

    public $timestamps = false;
}

?>