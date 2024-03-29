<?php
namespace App\Services\Message;
use App\Services\Base\BaseService;
use Illuminate\Database\Eloquent\Model;

class MessageService extends BaseService implements MessageServiceInterface{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function handleMessages($update)
    {

    }
}
