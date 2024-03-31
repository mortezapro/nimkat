<?php
namespace App\Services\MessageReaction;
use App\Models\MessageReactionModel;
use App\Services\Base\BaseService;

class MessageReactionService extends BaseService implements MessageReactionServiceInterface{
    protected MessageReactionModel $model;

    public function __construct(MessageReactionModel $model)
    {
        $this->model = $model;
    }
}
