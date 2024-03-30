<?php
namespace App\Services\User;

use App\Models\User;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UserService extends BaseService  {
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
