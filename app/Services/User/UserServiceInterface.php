<?php
namespace App\Services\User;

use App\Services\Base\BaseService;
use App\Services\Base\BaseServiceInterface;
use http\Exception;

interface UserServiceInterface extends BaseServiceInterface {
    public function exist($id);
}
