<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use Elasticsearch\ClientBuilder;

class ElasticSearchProductService {

    protected $client;
    private string $index_name = 'errandia';
    private string $type = 'item';

    protected $settings = [
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
                            'type' => 'synonym',
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
                    'description' => ['type' => 'text', 'analyzer' => 'search_index'],
                    'tags' => ['type' => 'text'],
                    'service' => ['type' => 'boolean'],
                    'status' => ['type' => 'boolean'],
                    'unit_price' => ['type' => 'long'],
                    'quantity' => ['type' => 'integer'],
                    'shop' => [
                        'type' => 'nested',
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'name' => ['type' => 'keyword'],
                            'description' => ['type' => 'text', 'analyzer' => 'search_index'],
                            'region' => [
                                'type' => 'nested',
                                'properties' => [
                                    'id' => ['type' => 'integer'],
                                    'name' => ['type' => 'keyword'],
                                ]
                            ],
                            'town' => [
                                'type' => 'nested',
                                'properties' => [
                                    'id' => ['type' => 'integer'],
                                    'name' => ['type' => 'keyword'],
                                ]
                            ],
                            'street' => [
                                'type' => 'text'
                            ]
                        ]
                    ],
                    'categories' => ['type' => 'keyword'],
                    'category_ids' => ['type' => 'keyword'],
                ]
            ]
        ]
    ];

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
        if(!$this->client->indices()->exists(['index' => $this->index_name])) {
            $this->settings['index'] = $this->index_name;
            $this->client->indices()->create($this->settings);
        }
    }

    public static function init()
    {
        return new ElasticSearchProductService();
    }

    public function create_document($id, $item)
    {
        $this->client->index([
            'index' => $this->index_name,
            'id' => $id,
            'body' => $this->getDocument($item)
        ]);
        logger()->info('document indexed');
    }

    public function bulk_documents($items = array())
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

    public function search($search_term, $page)
    {
        $params = [
            'index' => $this->index_name,
            'from' => intval($page) < 1 ? 0 : (intval($page) - 1) * 10,
            'size' => 10,
            'body' => [
                'query' => [
                    'bool' => [
                        'should' => [
                            ['match' => ['name' => $search_term]],
                            ['match' => ['shop.name' => $search_term]],
                            ['match' => ['description' => $search_term]],
                            ['match' => ['shop.description' => $search_term]],
                        ]
                    ]
                ],
                'aggs' => [
                    'types' => [
                        "terms" => ['field' =>  'service']
                    ]
                ]
            ]
        ];

        return $this->client->search($params);
    }

    public function update_docuemnt($id, $item)
    {
        $this->client->update([
            'index' => $this->index_name,
            'id' => $id,
            'body' => $this->getDocument($item)
        ]);
        logger()->info('document updated');
    }

    public function delete_docuemnt($id)
    {
        $this->client->index([
            'index' => $this->index_name,
            'id' => $id,
        ]);
        logger()->info('document deleted');
    }



    private function getDocument($item)
    {
        $product = new ProductResource($item);

        return $product->toArray(request());
    }


    public function flush_index()
    {
        $this->client->indices()->delete([
            'index' => $this->index_name,
        ]);
        logger()->info('index deleted');
    }

}