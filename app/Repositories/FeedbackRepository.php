<?php
namespace App\Repositories;

use App\Contracts\FeedbackRepositoryInterface;
use App\DTOs\FeedbackDTO;
use App\Models\FeedbackModel;
use App\Models\PostModel;
use Illuminate\Pagination\LengthAwarePaginator;

class FeedbackRepository implements FeedbackRepositoryInterface {
    public function getById(int $id): FeedbackModel|null
    {
        return FeedbackModel::find($id);
    }

    public function addOrUpdate(PostModel $post, FeedbackDTO $data): FeedbackModel
    {
        $feedback = $post->feedback()->UserId($data->getUserId())->first();
        if(!empty($feedback)){ // update feedback
            $feedback->action = $data->getAction();
            $feedback->save();
        }else{ // new feedback
            $feedback = new FeedbackModel(['action'=>$data->getAction(),
                                           'user_id'=>$data->getUserId()]);
            $post->feedback()->save($feedback);

        }

        return $feedback;
    }

    public function update(FeedbackModel $feedback, FeedbackDTO $data): FeedbackModel
    {
        $feedback->update(['action'=>$data->getAction()]);
        return $feedback;
    }

    public function delete(FeedbackModel $feedback): void
    {
        $feedback->delete();
    }

    public function paginate(PostModel $post): LengthAwarePaginator
    {
        return $post->feedback()->paginate();
    }
}
