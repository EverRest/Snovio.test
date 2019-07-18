<?php


namespace App\Repositories;


use App\Email;
use App\Library\Services\Repository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EmailRepository
 * @package App\Repositories
 */
class EmailRepository extends Repository
{
    /**
     * @return Email[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function all(): Collection
    {
        return Email::all();
    }
}