<?php


namespace App\Repositories;


use App\Library\Services\Repository;
use App\Link;

/**
 * Class LinkRepository
 * @package App\Repositories
 */
class LinkRepository extends Repository
{
    /**
     * LinkRepository constructor.
     * @param Link $link
     */
    public function __construct(Link $link)
    {
        $this->model = $link;
    }
}