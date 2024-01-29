<?php

namespace App\Services;

use Elastic\Elasticsearch\ClientBuilder;

class EsService
{
    private $client;
    private $index_name;
    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts(
                config('database.connections.elasticsearch.hosts')
            )
            ->build();
    }

    public function saveRecord($data)
    {

    }

    public function search($keyword, $filter = null)
    {

    }

    public function deleteRecord()
    {

    }
}