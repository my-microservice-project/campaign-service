<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidCampaignTypeException extends BaseException
{
    public function __construct()
    {
        parent::__construct(__('messages.invalid_campaign_type'), Response::HTTP_BAD_REQUEST);
    }
}
