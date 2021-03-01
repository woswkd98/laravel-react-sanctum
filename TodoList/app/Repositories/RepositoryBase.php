<?php

namespace App\Repositories;

interface RepositoryBase
{
    public function create(array $datas);
    public function update($id, array $datas);
    public function delete($id);
    public function read();
    public function findByPK($id);
}
