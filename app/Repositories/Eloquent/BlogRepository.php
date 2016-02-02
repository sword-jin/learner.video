<?php

namespace Learner\Repositories\Eloquent;

use Carbon\Carbon;
use Learner\Models\Blog;
use Learner\Repositories\BlogRepositoryInterface;
use Learner\Services\Forms\CreateBlogFormService;
use Learner\Services\Forms\UpdateBlogFormService;

class BlogRepository extends AbstractRepository implements BlogRepositoryInterface
{
    /**
     * Blog relation.
     *
     * @var array
     */
    protected static $relations = ['category'];

    /**
     * Create a new Blog instance.
     *
     * @param \Learner\Models\Blog $blog
     */
    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    /**
     * Paginate all published blogs.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findAllPublishedPaginated($perPage = 10)
    {
        return $this->model
                    ->with(static::$relations)
                    ->where('is_published', 1)
                    ->orderBy('is_top', 'DESC')
                    ->orderBy('created_at', 'DESC')
                    ->paginate($perPage);
    }

    /**
     * Get published blog by id.
     *
     * @param  integer $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Learner\Models\Blog[]
     */
    public function findPublishedById($id)
    {
        return $this->model
                    ->where('is_published', 1)
                    ->whereId($id)
                    ->firstOrFail();
    }

    /**
     * Get save blog form.
     *
     * @return \Learner\Services\Forms\CreateBlogFormService
     */
    public function getCreateForm()
    {
        return new CreateBlogFormService;
    }

    /**
     * Get update blog form.
     *
     * @return \Learner\Services\Forms\UpdateBlogFormService
     */
    public function getUpdateForm()
    {
        return new UpdateBlogFormService;
    }

    /**
     * Create new blog.
     *
     * @param  array  $data
     */
    public function create(array $data)
    {
        $blog = $this->getNew();

        $blog->title = $data['title'];
        $blog->body = $data['body'];
        $blog->category_id = $data['category_id'];

        if (key_exists('created_at', $data)) {
            $blog->created_at = $data['created_at'];
        }

        $blog->save();
    }

    /**
     * Update new blog.
     *
     * @param  array  $data
     */
    public function update($id, array $data)
    {
        $blog = $this->findById($id);

        $blog->title = $data['title'];
        $blog->body = $data['body'];
        $blog->category_id = $data['category_id'];

        if (key_exists('created_at', $data)) {
            $blog->created_at = $data['created_at'];
        }

        $blog->save();
    }

    /**
     * Delete a blog.
     *
     * @param  integer $id
     *
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * Change blog's published status.
     *
     * @param  integer $id
     *
     * @return boolean
     */
    public function togglePublished($id)
    {
        $blog = $this->findById($id);
        $blog->is_published = ! $blog->is_published;
        $blog->save();

        return $blog->is_published;
    }

    /**
     * Change blog's toped status.
     *
     * @param  integer $id
     *
     * @return boolean
     */
    public function toggleTop($id)
    {
        $blog = $this->findById($id);

        $blog->update([
            'is_top' => ! $blog->is_top
        ]);

        return $blog->is_top;
    }

    /**
     * Find all blog with category.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Blog[]
     */
    public function findAllWithRelation()
    {
        return $this->model
                    ->with(static::$relations)
                    ->orderBy('is_top', 'DESC')
                    ->orderBy('is_published')
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }
}
