<?php
namespace App\Services\Message;
use App\Models\MessageModel;
use App\Services\Base\BaseService;
use Illuminate\Database\Eloquent\Model;

class MessageService extends BaseService implements MessageServiceInterface{
    protected Model $model;
    public function __construct(MessageModel $model)
    {
        $this->model = $model;
    }

    public function handleMessages($update)
    {

    }
}
