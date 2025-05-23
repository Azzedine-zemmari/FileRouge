<?php

namespace App\Repositories\Contracts;

interface RoleChangeRequestInterface{
    public function create(array $data);
    public function getAll();
    public function approved($requestId);
    public function rejected($requestId);
}