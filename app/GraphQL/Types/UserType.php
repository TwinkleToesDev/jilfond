<?php

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\User;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'A user type',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the user',
            ],
            'username' => [
                'type' => Type::string(),
                'description' => 'The username of the user',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the user',
            ],
        ];
    }
}
