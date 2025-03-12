<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $elasticsearch;

    public function __construct()
    {
        $this->elasticsearch = ClientBuilder::create()
            ->setHosts(['localhost:9200'])
            ->build();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contacts = Contact::with(['user', 'opportunities', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        return response()->json($contacts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contacts',
            'phone' => 'nullable|string',
        ]);

        $contact = Contact::create($request->all());

        return response()->json($contact, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return response()->json($contact->load('tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->all());

        return response()->json($contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json(null, 204);
    }

    public function searchContacts(Request $request)
    {
        $query = [
            'index' => 'contacts',  // Index của Elasticsearch
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => []
                    ]
                ]
            ]
        ];

        // Nếu có search text
        if ($request->filled('search')) {
            $query['body']['query']['bool']['must'][] = [
                'multi_match' => [
                    'query' => $request->search,
                    'fields' => ['name', 'email', 'tags.name']
                ]
            ];
        }

        // Nếu có filter theo ngày tạo
        if ($request->filled('created_at')) {
            $query['body']['query']['bool']['must'][] = [
                'range' => [
                    'created_at' => [
                        'gte' => $request->created_at
                    ]
                ]
            ];
        }

        // Nếu có filter theo email
        if ($request->filled('email')) {
            $query['body']['query']['bool']['must'][] = [
                'match' => ['email' => $request->email]
            ];
        }

        // Nếu có filter theo tag
        if ($request->filled('tags')) {
            $query['body']['query']['bool']['must'][] = [
                'terms' => ['tags' => $request->tags]
            ];
        }

        // Nếu có filter theo Manager
        if ($request->filled('manager')) {
            $query['body']['query']['bool']['must'][] = [
                'match' => ['manager' => $request->manager]
            ];
        }

        $results = $this->elasticsearch->search($query);

        return response()->json($results['hits']['hits']);
    }
}
