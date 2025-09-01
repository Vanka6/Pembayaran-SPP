<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        try {
            return $this->userRepository->findAll();
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil semua data user: " . $e->getMessage(), 0, $e);
        }
    }

    public function getById($id)
    {
        try {
            return $this->userRepository->findById($id);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil user ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->create($data);

            // $profile = $this->profileRepository->create([
            //     'user_id' => $user->id
            // ]);

            DB::commit();

            return [
                'user' => $user,
                // 'profile' => $profile
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal membuat user: " . $e->getMessage(), 0, $e);
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->update($id, $data);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate user ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->delete($id);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus user ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }
}
