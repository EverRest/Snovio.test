<?php


namespace App\Repositories;


use App\Email;
use App\Library\Services\Repository;

/**
 * Class EmailRepository
 * @package App\Repositories
 */
class EmailRepository extends Repository
{
    /**
     * EmailRepository constructor.
     * @param Email $email
     */
    public function __construct(Email $email)
    {
        $this->model = $email;
    }
}