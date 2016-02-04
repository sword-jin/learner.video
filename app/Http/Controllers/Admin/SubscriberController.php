<?php

namespace Learner\Http\Controllers\Admin;

use News;
use Learner\Http\Controllers\Admin\BaseController;
use Learner\Repositories\SubscriberRepositoryInterface;

class SubscriberController extends BaseController
{
    /**
     * Subscriber repository.
     *
     * @var \Learner\Repositories\SubscriberRepositoryInterface $subscribers
     */
    protected $subscribers;

    /**
     * Instance the subscriber repository.
     *
     * @param \Learner\Repositories\SubscriberRepositoryInterface $subscribers
     */
    public function __construct(SubscriberRepositoryInterface $subscribers)
    {
        $this->subscribers = $subscribers;
    }

    /**
     * Get all subscribers.
     *
     * /admin/subscribers get
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $subscribers = $this->subscribers->listEmailPaginated(50);

        return $this->responseJson(compact('subscribers'));
    }

    /**
     * Remove a subscriber from database.
     *
     * /admin/subscribers/{email} delete
     *
     * @param  integer $email
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destory($email)
    {
        if ($this->subscribers->deleteByEmail($email)) {
            News::unsubscribe($email);
        }

        return $this->responseJson(['message' => '删除成功']);
    }
}
