<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParseStoreRequest;
use Illuminate\Http\Request;

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

    public function store(ParseStoreRequest $request)
    {
        dd($request->all());
    }
}
