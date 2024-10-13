<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserSearchQuery extends Query
{
    protected $attributes = [
        'name' => 'userSearch',
        'description' => 'Search users by ID, username, or name',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('user'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::listOf(Type::int()),
                'description' => 'Filter by user IDs',
            ],
            'search' => [
                'name' => 'search',
                'type' => Type::string(),
                'description' => 'Filter by user usernames',
            ],
            'limit' => [
                'name' => 'limit',
                'type' => Type::int(),
                'description' => 'Limit the number of results returned',
            ],
        ];
    }

    public function rules(array $args = []): array
    {
        return [
            'id' => ['nullable', 'array'],
            'id.*' => ['integer'],
            'search' => ['nullable', 'string'],
        ];
    }

    public function messages(array $args = []): array
    {
        return [
            'search.string' => 'The search term must be a string.',
        ];
    }

    public function resolve($root, $args): \Illuminate\Database\Eloquent\Collection
    {
        $query = User::query();

        if (isset($args['id'])) {
            $query->whereIn('id', $args['id']);
        }

        if (isset($args['search'])) {
            $this->applySearchFilter($query, $args['search']);
        }

        if (isset($args['limit'])) {
            $query->limit($args['limit']);
        }

        return $query->get();
    }

    private function applySearchFilter($query, string $search): void
    {
        $searchTerms = array_map('trim', explode(',', $search));

        $query->where(function ($query) use ($searchTerms) {
            foreach ($searchTerms as $term) {
                if (is_numeric($term)) {
                    $query->orWhere('id', $term);
                    break;
                }

                $query->orWhere('username', 'ilike', '%' . $term . '%');
            }
        });
    }
}
