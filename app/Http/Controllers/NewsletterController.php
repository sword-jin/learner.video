<?php

namespace Learner\Http\Controllers;

use News;
use Illuminate\Http\Request;
use Learner\Http\Controllers\BaseController;
use Learner\Service\Newsletter\NewsletterInterface;
use Learner\Repositories\SubscriberRepositoryInterface;

class NewsletterController extends BaseController
{
    /**
     * Get newsletters list.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('newsletters.index');
    }

    /**
     * Subscriber repository
     *
     * @var \Learner\Repositories\SubscriberRepositoryInterface
     */
    protected $subscribers;

    public function __construct(SubscriberRepositoryInterface $subscribers)
    {
        $this->subscribers = $subscribers;
    }

    /**
     * Subscribe a user to list.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Request $request)
    {
        $email = $request->get('email');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flashy()->error(lang('newsletters.not_valid_email', 'Your email is not valid!'));
        } else {
            if ($this->subscribers->store($email)) {
                flashy()->success(lang('newsletters.subscribe_success', 'Thank for subscribing!'));

                News::subscribe($email);
            } else {
                flashy()->info(lang('newsletters.subscriber_exists', 'Your have subscribed! Thanks.'));
            }
        }

        return $this->redirectBack();
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsubscribe()
    {
        //
    }
}
