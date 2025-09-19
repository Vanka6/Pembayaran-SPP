<?php

namespace App\Services\Interfaces;

interface UserServiceInterface
{
    public function getAll();
    public function getById($id);
    public function getByEmail(string $email);
    public function getAvailableStudentUsers(?string $status = null, ?string $excludeEmail = null);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
}
