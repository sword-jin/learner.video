<?php

namespace Learner\Repositories\Eloquent;

use Learner\Models\Newsletter;
use Illuminate\Database\Eloquent\paginate;
use Learner\Repositories\NewsletterRepositoryInterface;

class NewsletterRepository extends AbstractRepository implements NewsletterRepositoryInterface
{
    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Newsletter $newsletter
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->model = $newsletter;
    }

    /**
     * Find all newsletter.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return $this->model
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }

    /**
     * Find all published newsletters.
     *
     * @param  integer $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findAllPublishedWithPaginator($perPage = 10)
    {
        return $this->model
                    ->where('is_published', 1)
                    ->paginate($perPage);
    }

    /**
     * Find published newsletter by id.
     *
     * @param  integer $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findPublishedWithRelationById($id)
    {
        return $this->model
                    ->with(['links' => function($query) {
                        return $query->orderBy('type');
                    }])
                    ->where('is_published', 1)
                    ->findOrFail($id);
    }

    /**
     * Store a new newsletter.
     *
     * @param  string $title
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function store($title)
    {
        $newsletter = $this->getNew();

        $newsletter->title = $title;

        $newsletter->save();

        return $newsletter;
    }

    /**
     * Delete a newsletter.
     *
     * @param  integer $id
     */
    public function delete($id)
    {
        $this->findById($id)->delete();
    }

    /**
     * Get all link of given ids' newsletter
     *
     * @param  integer $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getNewletterLinkById($id)
    {
        return $this->model
                    ->with(['links' => function($query) {
                        return $query->orderBy('type');
                    }])
                    ->findOrFail($id);
    }
}
