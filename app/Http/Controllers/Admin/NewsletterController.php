<?php

namespace Learner\Http\Controllers\Admin;

use Log;
use News;
use View;
use Request;
use Learner\Http\Controllers\Admin\BaseController;
use Learner\Repositories\NewsletterRepositoryInterface;

class NewsletterController extends BaseController
{
    /**
     * Newsletter repository.
     *
     * @var \Learner\Repositories\NewsletterRepositoryInterface
     */
    protected $news;

    /**
     * Instance Newsletter Repository.
     *
     * @param \Learner\Repositories\NewsletterRepositoryInterface $news
     */
    public function __construct(NewsletterRepositoryInterface $news)
    {
        $this->news = $news;
    }

    /**
     * All newsletter.
     *
     * /admin/newsletters get
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $newsletters = $this->news->findAll();

        return $this->responseJson(compact('newsletters'));
    }

    /**
     * Store the first newsletter.
     *
     * /admin/newsletters post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $newsletter = $this->news->store(Request::get('title'));

        return $this->responseJson([
            'message' => '添加成功,　你现在可以去给该newsletter添加内容了',
            'newsletter' => $newsletter
        ]);
    }

    /**
     * Delete a newsletter.
     *
     * /newsletters/publish/{id} delete
     *
     * @param  integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destory($id)
    {
        $this->news->delete($id);

        Log::info(lang('log.deleteNewsletterSuccess', 'You delete a newsletter.'));

        return $this->responseJson(['message' => '删除成功']);
    }

    /**
     * Publish a newsletter.
     *
     * /admin/newsletters/publish/{id} post
     *
     * @param  integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish($id)
    {
        // select newsletter.
        $newsletter = $this->news->getNewletterLinkById($id);
        // check has links.
        if (! count($newsletter->links)) {
            return $this->responseJson(['error' => '请先添加内容'], 400);
        }
        // make view.
        $subject = $newsletter->title;
        $content = View::make('newsletters.template', compact('newsletter'))->render();
        // connect mailcamp.
        News::send($subject, $content);
        // change is_published.
        $newsletter->update(['is_published' => 1]);

        return $this->responseJson(['message' => '成功发布，你可以去 mailchimp.com 查看实时信息']);
    }
}
