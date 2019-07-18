<?php


namespace App\Library\Services;


use App\Library\Contracts\RepositoryInterface;

/**
 * Class Repository
 * @package App\Library\Services
 */
class Repository implements RepositoryInterface
{
    /**
     * @var
     */
    public $model;
    /**
     * @return mixed
     */
    public function all()
    {

    }
    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id = 0)
    {

    }
    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data = [])
    {

    }
    /**
     * @param array $data
     * @return mixed
     */
    public function saveMany(array $data = [])
    {

    }
    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id = 0, array $data = [])
    {

    }
    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id = 0)
    {

    }
}