<?php

namespace Learner\Http\Controllers;

use News;
use Illuminate\Http\Request;
use Learner\Http\Controllers\BaseController;
use Learner\Repositories\NewsletterRepositoryInterface;
use Learner\Repositories\SubscriberRepositoryInterface;

class NewsletterController extends BaseController
{
    /**
     * Subscriber repository
     *
     * @var \Learner\Repositories\SubscriberRepositoryInterface
     */
    protected $subscribers;

    /**
     * Newsletter repository
     *
     * @var \Learner\Repositories\NewsRepositoryInterface
     */
    protected $news;

    /**
     * Instance subsciber repository.
     *
     * @param \Learner\Repositories\SubscriberRepositoryInterface $subscribers
     * @param \Spatie\Newsletter\Interfaces\NewsletterInterface $news
     */
    public function __construct(SubscriberRepositoryInterface $subscribers, NewsletterRepositoryInterface $news)
    {
        $this->subscribers = $subscribers;
        $this->news = $news;
    }

     /**
     * Get newsletters list.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $newsletters = $this->news->findAllPublishedWithPaginator(10);

        return view('newsletters.index', compact('newsletters'));
    }

    /**
     * Show a newsletter.
     *
     * @param  integer $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $newsletter = $this->news->findPublishedWithRelationById($id);

        return view('newsletters.show', compact('newsletter'));
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
