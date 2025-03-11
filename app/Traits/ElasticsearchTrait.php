<?php

namespace App\Traits;

use Elasticsearch\ClientBuilder;

trait ElasticsearchTrait
{
    public static function search($query)
    {
        $client = ClientBuilder::create()
            ->setHosts([env('ELASTICSEARCH_HOST', 'http://localhost:9200')])
            ->build();

        $params = [
            'index' => (new self)->getTable(),
            'body' => [
                'query' => [
                    'match' => [
                        'name' => $query
                    ]
                ]
            ]
        ];

        $results = $client->search($params);
        return collect($results['hits']['hits'])->pluck('_source');
    }
}
