<?php

namespace App\Services;

use App\Models\Synonym;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class ElasticSearchProductService {

    protected Client $client;
    private string $index_name = 'errandia';

    protected array $settings = [
        'body' => [
            'settings' => [
                'number_of_shards' => 3,
                'number_of_replicas' => 2,
                'analysis' => [
                    'analyzer' => [
                        'search_index' => [
                            'tokenizer' => 'standard',
                            'filter' => ['lowercase','asciifolding', 'synonym', 'german'],
                        ]
                    ],
                    'filter' => [
                        'synonym' => [
                            'type' => 'synonym_graph',
                            'ignore_case' => true,
                            'synonyms' => [],
                        ],
                        'german' => [
                            'type' => 'stemmer',
                            'ignore_case' => true,
                            'name' => 'german',
                        ]
                    ],
                ]

            ],
            'mappings' => [
                'properties' => [
                    'name' => ['type' => 'text', 'analyzer' => 'search_index'],
                    'description' => ['type' => 'text'],
                    'tags' => ['type' => 'text', 'analyzer' => 'search_index'],
                    'service' => ['type' => 'integer'],
                    'status' => ['type' => 'boolean'],
                    'unit_price' => ['type' => 'long'],
                    'quantity' => ['type' => 'integer'],
                    'category' => [
                        'type' => 'nested',
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'name' => ['type' => 'text', 'analyzer' => 'search_index'],
                            'description' => ['type' => 'text'],
                        ]
                    ],
                    'shop' => [
                        'type' => 'nested',
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'name' => ['type' => 'text', 'analyzer' => 'search_index'],
                            'description' => ['type' => 'text']
                        ]
                    ],
                    'categories' => ['type' => 'keyword'],
                    'category_ids' => ['type' => 'keyword'],
                    'region_id' => ['type' => 'integer'],
                    'town_id' => ['type' => 'integer'],
                    'region_name' => ['type' => 'keyword'],
                    'town_name' => ['type' => 'keyword'],
                    'street' => ['type' => 'text'],
                ]
            ]
        ]
    ];

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
        if(!$this->client->indices()->exists(['index' => $this->index_name])) {
            $this->settings['index'] = $this->index_name;
            $this->settings['body']['settings']['analysis']['filter']['synonym']['synonyms'] = Synonym::build_from_sub_categories();
            $this->client->indices()->create($this->settings);
        }
    }

    public static function init(): ElasticSearchProductService
    {
        return new ElasticSearchProductService();
    }

    public function create_document($id, $item): void
    {
        $this->client->index([
            'index' => $this->index_name,
            'id' => $id,
            'body' => $this->getDocument($item)
        ]);
        logger()->info('document indexed');
    }

    public function bulk_documents($items = array()): void
    {
        $params['body'] = [];
        foreach ($items as $item) {
            $params['body'][] = [
                'index' => [
                    '_index' => $this->index_name,
                    '_id' => $item->id,
                ]
            ];
            $params['body'][] = $this->getDocument($item);
        }

        if (!empty($items)) {
            $this->client->bulk($params);
            logger()->info('documents indexed');
        }
    }

    public function search($search_term, $filter = [], $page = 1): callable|array
    {
        $query = [];
        $query['must'] = [
            'bool' => [
                'should' => [
                    ['query_string' => ['default_field' => 'name', 'query' => $search_term]],
                    ['match' => ['name' => ['query' => $search_term, 'boost' => 10]]],
                    ['wildcard' => ['name' => '*'. $search_term]],
                    ['wildcard' => ['name' => $search_term. '*']],
                    ['query_string' => ['default_field' => 'tags', 'query' => $search_term]],
                ]
            ]
        ];
        $query['should'] = [
            ['match' => ['tags' => ['query' => $search_term]]],
            ['match' => ['category.name' => $search_term]],
            ['match' => ['shop.name' => $search_term]],
            ['match' => ['description' => $search_term]],
            ['match' => ['category.description' => $search_term]],
            ['match' => ['shop.description' => $search_term]]
        ];

        // Apply filter
        if (!empty($filter)) {
            $query['filter'] = [];

            if(isset($filter['service'])) {
                $query['filter'][] = ['term' => ['service' => $filter['service']]] ;
            }

            if(isset($filter['region'])) {
                $query['filter'][] = ['term' => ['region_id' => $filter['region']]] ;
            }

            if(isset($filter['town'])) {
                $query['filter'][] = ['term' => ['town_id' => $filter['town']]] ;
            }
        }

        $params = [
            'index' => $this->index_name,
            'body' => [
                'query' => ['bool' => $query],
                'aggs' => [
                    'types' => [
                        "terms" => ['field' =>  'service']
                    ]
                ],
                'sort' => [
                    ['_score' => 'desc']
                ]
            ]
        ];

        if ($page != null) {
            $params['from'] = intval($page) < 1 ? 0 : (intval($page) - 1) * 10;
            $params['size'] = 10;
        }

        return $this->client->search($params);
    }

    public function update_document($id, $item): void
    {
        $this->client->update([
            'index' => $this->index_name,
            'id' => $id,
            'body' => ['doc' => $this->getDocument($item)]
        ]);
        logger()->info('document updated');
    }

    public function delete_document($id): void
    {
        $this->client->index([
            'index' => $this->index_name,
            'id' => $id,
        ]);
        logger()->info('document deleted');
    }



    private function getDocument($item): array
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'unit_price' => $item->unit_price,
            'quantity' => $item->quantity,
            'service' => $item->service,
            'status' => $item->status == 1,
            'tags' => $item->name . ',' . $item->tags,
            'category' => [
                'id' => $item->category->id,
                'name' => $item->category->name,
                'description' => $item->category->description,
            ],
            'shop' => [
                'id' => $item->shop->id,
                'name' => $item->shop->name,
                'description' => $item->shop->description,
            ],
            'region_id' => $item->shop->region->id,
            'region_name' => $item->shop->region->name,
            'town_id' => $item->shop->town ? $item->shop->town->id : 0,
            'town_name' => $item->shop->town ? $item->shop->town->name :  '',
        ];
    }



    public function flush_index(): void
    {
        $this->client->indices()->delete([
            'index' => $this->index_name,
        ]);
        logger()->info('index deleted');
    }

}