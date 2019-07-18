<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParseStoreRequest;
use App\Library\Contracts\ParserInterface;

/**
 * Class ParseController
 * @package App\Http\Controllers
 */
class ParseController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * @param ParseStoreRequest $request
     * @param ParserInterface $parser
     */
    public function store(ParseStoreRequest $request, ParserInterface $parser)
    {
        $parser->parse($request->all(['url', 'deep', 'quantity']));
    }
}
