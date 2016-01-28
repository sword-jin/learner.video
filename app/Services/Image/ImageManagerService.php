<?php

namespace Learner\Services\Image;

use Image;

class ImageManagerService
{
    use ImageTrait;

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

    protected static $seriesPath = 'img/series';

    protected static $videoPath = 'img/video';

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
     * @param  string $image
     *
     * @return string
     */
    public function saveSeriesImage($image)
    {
        $img = Image::make($image->getRealPath());;

        $img->fit(self::$seriesWidth, self::$seriesHeight);

        $filepath = $this->randomSeriesPath($image->getClientOriginalExtension());
        $fullpath = $this->getFullpath($filepath);

        $img->save($fullpath);

        return $filepath;
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

    /**
     * Create the dir.
     */
    protected function createDir()
    {
        $series = public_path() . '/' . self::$seriesPath;
        $video = public_path() . '/' . self::$videoPath;

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
