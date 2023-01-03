<?php

namespace App\Actions\Nangu\GraphQL\oAuth;

use Softonic\GraphQL\ClientBuilder;

class NanguOAuthGraphQlAction
{
    public function execute(string $username, string $password)
    {
        $client = ClientBuilder::build(config('app.nangu_graphql'));

        $mutation = <<<'MUTATION'
        mutation mutateLogin($clientId: String!, $clientMutationId: String, $clientSecret: String!, $clientVersion: String, $deviceId: String, $deviceType: DeviceType, $password: String!, $username: String!) {
            login(input: {clientId: $clientId, clientMutationId: $clientMutationId, clientSecret: $clientSecret, clientVersion: $clientVersion, deviceId: $deviceId, deviceType: $deviceType, password: $password, username: $username}) {
              token
              refreshToken
              expiresIn
              __typename
            }
          }
        MUTATION;
        $variables = [
            "clientId" => "grapesc-new-webportal",
            "clientSecret" => "fie4ulai5aimoh9aikeiFahthee9Ai",
            "password" => $password,
            "username" => $username
        ];

        /** @var \Softonic\GraphQL\Client $client */
        $response = $client->query($mutation, $variables);

        if ($response->hasErrors()) {
            return $response->getErrors();
        } else {
            return $response->getData();
        }
    }
}
