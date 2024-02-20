<?php

namespace App\Http\Controllers;

use App\Service\OzonService;

class ParserController extends Controller
{
    public function products(OzonService $ozonService): array
    {
        return $ozonService->getProductList();;
    }
}
