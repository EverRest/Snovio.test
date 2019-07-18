<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParseStoreRequest;
use App\Library\Contracts\ParserInterface;
use App\Repositories\EmailRepository;
use App\Repositories\LinkRepository;
use Illuminate\View\View;

/**
 * Class ParseController
 * @package App\Http\Controllers
 */
class ParseController extends Controller
{
    /**
     * @var EmailRepository
     */
    public $emailRepo;
    /**
     * @var LinkRepository
     */
    public $linkRepo;
    /**
     * ParseController constructor.
     * @param EmailRepository $email
     * @param LinkRepository $link
     */
    public function __construct(EmailRepository $email, LinkRepository $link)
    {
        $this->emailRepo = $email;
        $this->linkRepo = $link;
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
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
