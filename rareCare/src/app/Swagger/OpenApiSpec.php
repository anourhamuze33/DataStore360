<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Patients API",
 *     version="1.0.0",
 *     description="API for managing patients with rare diseases"
 * )
 * 
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Local API Server"
 * )
 */
class OpenApiSpec
{
}