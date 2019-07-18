<?php


namespace App\Repositories;


use App\Library\Services\Repository;
use App\Link;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class LinkRepository
 * @package App\Repositories
 */
class LinkRepository extends Repository
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Link::all();
    }
}