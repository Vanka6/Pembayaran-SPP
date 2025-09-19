<?php

namespace App\Services\Interfaces;

interface SchoolYearServiceInterface
{
    public function getAll();
    public function getById($id);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
}
