<?php

namespace Learner\Http\Controllers\Admin;

use Log;
use Auth;
use Hash;
use ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Learner\Http\Controllers\Admin\BaseController;
use Learner\Repositories\CategoryRepositoryInterface;

class CategoryController extends BaseController
{
    /**
     * Category repository.
     *
     * @var \Learner\Repositories\CategoryRepositoryInterface $categories
     */
    protected $categories;

    /**
     * Instance category repository.
     *
     * @param \Learner\Repositories\CategoryRepositoryInterface $categories
     */
    public function __construct(CategoryRepositoryInterface $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get all categories.
     *
     * /admin/categories get
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Category[]
     */
    public function index()
    {
        return $this->categories->findAll();
    }

    /**
     * Store a category.
     *
     * /admin/categories post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $form = $this->categories->getCreateForm();

        if (! $form->isValid()) {
            return $this->responseJson(['errors' => $form->getErrors()], 400);
        }

        $data = $form->getInputData();

        $data = $this->categories->create([
            'name' => $data['name'],
            'image' => ImageManager::saveCategoryImage($data['image'])
        ]);

        return $this->responseJson(['message' => '分类创建成功', 'data' => $data]);
    }

    /**
     * Update a category.
     *
     * /admin/categories/update/{id}
     *
     * @param  integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $form = $this->categories->getUpdateForm();

        if (! $form->isValid()) {
            return $this->responseJson(['errors' => $form->getErrors()], 400);
        }

        $cateData = $form->getInputData();
        $data = [
            'name' => $cateData['name']
        ];

        if (key_exists('image', $cateData)) {
            $imagePath = ImageManager::changeCategoryImage(
                    $cateData['image'],
                    $this->categories->findImageById($id)
            );

            $data['image'] = $imagePath;
        }

        $category = $this->categories->update($id, $data);

        return $this->responseJson(['message' => '分类修改成功', 'data' => $category]);
    }

    /**
     * Delete a category.
     *
     * /admin/categories/{id}
     *
     * @param  Request $request
     * @param  integer  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destory(Request $request, $id)
    {
        $truePassword = Auth::user()->password;

        if (Hash::check($request->get('password'), $truePassword)) {
            // delete image.
            ImageManager::delete($this->categories->findImageById($id));
            // remove from db.
            $this->categories->deleteById($id);

            Log::info(lang("log.deleteCategorySuccess", "You delete a category."));

            return $this->responseJson(['message' => '删除成功！']);
        }

        Log::warning(lang("log.deleteCategoryError", "MayBe Someone want delete your category."));

        return $this->responseJson(['error' => '密码错误，记录日志'], 403);
    }
}
