<?php

namespace Learner\Repositories\Eloquent;

use Learner\Models\Link;
use Learner\Services\Forms\SaveLinkFormService;
use Learner\Repositories\LinkRepositoryInterface;

class LinkRepository extends AbstractRepository implements LinkRepositoryInterface
{
    /**
     * Create a new Link instance.
     *
     * @param \Learner\Models\Link $link
     */
    public function __construct(Link $link)
    {
        $this->model = $link;
    }

    /**
     * Get the link save form
     *
     * @return \Learner\Services\Forms\SaveLinkFormService
     */
    public function getSaveForm()
    {
        return new SaveLinkFormService;
    }

    /**
     * Store a link.
     *
     * @param  array  $data
     *
     * @return array
     */
    public function store(array $data)
    {
        $link = $this->model->create($data);

        return $link->toArray();
    }

    /**
     * Update link.
     *
     * @param  integer $id
     * @param  array  $data
     *
     * @return array
     */
    public function update($id, array $data)
    {
        $link = $this->findById($id);

        $link->update($data);

        return $link->toArray();
    }

    /**
     * Get all link with paginator.
     *
     * @param $perPage = 50
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Learner\Models\Link[]
     */
    public function findAllPaginated($perPage = 50)
    {
        return $this->model
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);
    }

    /**
     * Delete a link.
     *
     * @param  integer $id
     */
    public function delete($id)
    {
        $link = $this->findById($id)->delete();
    }
}
