<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/', methods: [Request::METHOD_GET])]
class IndexController
{
    public function __invoke(HubInterface $hub): JsonResponse
    {
        $update = new Update('https://example.com/my-private-topic', json_encode(['random' => rand(1, 100)]));
        $hub->publish($update);

        return new JsonResponse('ok');
    }
}
