<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/example",
     *     summary="Example",
     *     tags={"example"},
     *     description="Get Exemplo",
     *     @OA\Response(response="default", description="List Items")
     * )
     */
    public function index(){

    }
}
