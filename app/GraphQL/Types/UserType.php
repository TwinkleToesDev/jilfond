<?php

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\User;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'User type',
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
            'about' => [
                'type' => Type::string(),
                'description' => 'The "About me" field',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of the user',
            ],
            'image_url' => [
                'type' => Type::string(),
                'description' => 'User image URL',
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'User phone number',
            ],
        ];
    }
}
