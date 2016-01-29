<?php

namespace Learner\Services\Image;

use Image;

class ImageManagerService
{
    use ManagerTrait;

    /**
     * The dimensions to width the series image to.
     *
     * @var int
     */
    protected static $seriesWidth = 680;

    /**
     * The dimensions to height the series image to.
     *
     * @var int
     */
    protected static $seriesHeight = 440;

    /**
     * The dimensions to width the category image to.
     *
     * @var int
     */
    protected static $cateWidth = 360;

    /**
     * The dimensions to height the category image to.
     *
     * @var int
     */
    protected static $cateHeight = 360;

    /**
     * The series image path in public folder.
     *
     * @var string
     */
    protected static $seriesPath = 'img/series';

    /**
     * The category image path in public folder.
     *
     * @var string
     */
    protected static $catePath = 'img/category';

    /**
     * Create the directory.
     */
    public function __construct()
    {
        $this->createDir();
    }

    /**
     * Save the series image.
     *
     * @param  Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return string
     */
    public function saveSeriesImage($image)
    {
        return $this->saveImage($image, 'series');
    }

    /**
     * Save the category image.
     *
     * @param  Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return string
     */
    public function saveCategoryImage($image)
    {
        return $this->saveImage($image, 'category');
    }

    protected function saveImage($image, $type = null)
    {
        if ($type == null) throw new Exception("Please specify a type image");

        $img = Image::make($image->getRealPath());

        if ($type == 'series') {
            $img->fit(self::$seriesWidth, self::$seriesHeight);

            $filepath = $this->randomSeriesPath($image->getClientOriginalExtension());
        } else if ($type == 'category') {
            $img->fit(self::$cateWidth, self::$cateHeight);

            $filepath = $this->randomCatePath($image->getClientOriginalExtension());
        }

        $img->save($this->getFullpath($filepath));

        return $filepath;
    }

    /**
     * Change the series image.
     *
     * @param  Symfony\Component\HttpFoundation\File\UploadedFile $image
     * @param  string $imagePath
     *
     * @return string
     */
    public function changeSeriesImage($image, $imagePath)
    {
        // remove origin image
        $this->delete($imagePath);
        // create new image
        return $this->saveSeriesImage($image);
    }

    public function changeCategoryImage($image, $imagePath)
    {
        // remove origin image
        $this->delete($imagePath);
        // create new image
        return $this->saveCategoryImage($image);
    }

    /**
     * Get the series random path.
     *
     * @param  string $extension
     * @return string
     */
    protected function randomSeriesPath($extension)
    {
        return self::$seriesPath . '/' .
            $this->randomName() . '.' .
            $extension;
    }

    protected function randomCatePath($extension)
    {
        return self::$catePath . '/' .
            $this->randomName() . '.' .
            $extension;
    }

    /**
     * Create the dir.
     */
    protected function createDir()
    {
        $series = public_path() . '/' . self::$seriesPath;
        $video = public_path() . '/' . self::$catePath;

        if (! is_dir($series)) {
            mkdir($series, 0777, true);
        }

        if (! is_dir($video)) {
            mkdir($video, 0777, true);
        }
    }

    /**
     * Generate a filename
     *
     * @return string
     */
    protected function randomName() {
        return str_random(16);
    }
}
