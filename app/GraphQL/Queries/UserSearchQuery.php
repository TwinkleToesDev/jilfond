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
            'search' => [
                'name' => 'search',
                'type' => Type::string(),
                'description' => 'Search term to filter users by id, username, or name',
            ],
        ];
    }

    public function rules(array $args = []): array
    {
        return [
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

        if (isset($args['search'])) {
            $searchTerm = $args['search'];

            $query->where(function($query) use ($searchTerm) {
                if (is_numeric($searchTerm)) {
                    $query->orWhere('id', $searchTerm);
                }

                $query->orWhere('username', 'ilike', '%' . $searchTerm . '%')
                    ->orWhere('name', 'ilike', '%' . $searchTerm . '%');
            });
        }

        return $query->get();
    }
}
