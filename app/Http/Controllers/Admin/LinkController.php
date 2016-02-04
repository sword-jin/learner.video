<?php

namespace Learner\Http\Controllers\Admin;

use Log;
use Learner\Repositories\LinkRepositoryInterface;
use Learner\Http\Controllers\Admin\BaseController;

class LinkController extends BaseController
{
    /**
     * Link repository.
     *
     * @var \Learner\Repositories\LinkRepositoryInterface $links
     */
    protected $links;

    /**
     * Instance the link repository.
     *
     * @param \Learner\Repositories\LinkRepositoryInterface $links
     */
    public function __construct(LinkRepositoryInterface $links)
    {
        $this->links = $links;
    }

    /**
     * Get all links.
     *
     * /admin/links get
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Link[]
     */
    public function index()
    {
        $links = $this->links->findAllPaginated(50);

        return $this->responseJson(compact('links'));
    }

    /**
     * Store the link.
     *
     * /admin/links post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $form = $this->links->getSaveForm();

        if (! $form->isValid()) {
            return $this->responseJson(['errors' => $form->getErrors()], 400);
        }

        $formData = $form->getInputData();

        $link = $this->links->store($formData);

        return $this->responseJson([
            'message' => '成功添加链接',
            'link' => $link
        ]);
    }

    /**
     * Update link by id.
     *
     * /admin/links/{id} put
     *
     * @param  integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $form = $this->links->getSaveForm();

        if (! $form->isValid()) {
            return $this->responseJson(['errors' => $form->getErrors()], 400);
        }

        $formData = $form->getInputData();

        $link = $this->links->update($id, $formData);

        return $this->responseJson([
            'message' => '成功修改链接',
            'link' => $link
        ]);
    }

    /**
     * Delete a link.
     *
     * /admin/links/{id} delete
     *
     * @param  integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destory($id)
    {
        $this->links->delete($id);

        Log::info(lang('log.deleteLinkSuccess', 'You delete a link.'));

        return $this->responseJson(['message' => '删除成功']);
    }
}
