<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParseStoreRequest;
use App\Contracts\ParserInterface;

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

    public function store(ParseStoreRequest $request, ParserInterface $parser)
    {
//        dd($request->all());
    }
}
