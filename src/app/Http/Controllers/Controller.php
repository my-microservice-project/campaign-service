<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    description: "Campaign API Documentation",
    title: "Campaign Service",
    contact: new OA\Contact(email: "bugrabozkurtt@gmail.com"),
    license: new OA\License(name: "MIT", url: "https://opensource.org/licenses/MIT")
)]
abstract class Controller
{
    //
}
