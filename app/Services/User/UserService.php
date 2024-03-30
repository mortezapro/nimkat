<?php
namespace App\Services\User;

use App\Models\User;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UserService extends  BaseService  {
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function exist(int $id)
    {
        // بعدا از کش خوانده شود. ترجیحا بعد از یک ماه
//        return Cache::remember('users.check.' . $id, 60*60*2, function () use ($id) {
//            return $this->model->where("id","=",$id)->exists();
//        });
        Log::info($this->model->where("id","=",$id)->exists());
        return $this->model->where("id","=",$id)->exists();
    }
}
