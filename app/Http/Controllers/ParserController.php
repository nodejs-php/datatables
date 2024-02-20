<?php

namespace App\Http\Controllers;

use App\Service\OzonService;

class ParserController extends Controller
{
    public function token(OzonService $ozonService)
    {
        $token = $ozonService->getToken();

        return $token ;
    }
}
