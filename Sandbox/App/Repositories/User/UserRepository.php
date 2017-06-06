<?php

namespace Sandbox\Repositories\User;

interface UserRepository {
    public function getAll();
    public function getById($id);
    public function add($job);
    public function delete($job);
}