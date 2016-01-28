<?php

namespace Learner\Services\Image;

use Avatar;
use Illuminate\Filesystem\Filesystem;

class AvatarManagerService extends ImageManagerService
{
    use ImageTrait;

    /**
     * The directory to safe image uploads to.
     *
     * @var string
     */
    protected static $directory = 'img/avatar/temp';

    /**
     * The dimensions to width the image to.
     *
     * @var int
     */
    protected static $width = 160;

    /**
     * The dimensions to height the image to.
     *
     * @var int
     */
    protected static $height = 160;

    /**
     * The dimensions to resize the font size to.
     *
     * @var int
     */
    protected static $fontSize = 80;

    /**
     * The quality the image should be saved in.
     *
     * @var int
     */
    protected static $quality = 100;

    /**
     * The extension to use for image files.
     *
     * @var string
     */
    protected static $extension = 'png';

    /**
     * Create the avatar directory.
     */
    public function __construct()
    {
        $this->createDirectory(self::$directory);
    }

    /**
     * Get the file path in public folder.
     *
     * @param  string $name
     *
     * @return string
     */
    protected function getFilePath($name)
    {
        return self::$directory . '/' . $name . '.' . self::$extension;
    }

    /**
     * Generate a avatar by a name.
     *
     * @param  string $name
     *
     * @return \Laravolt\Avatar\Avatar
     */
    public function generateAvatar($name)
    {
        $path = $this->getFilePath($name);

        Avatar::create(mb_strtoupper($name))
                ->setDimension(self::$width, self::$height)
                ->setFontSize(self::$fontSize)
                ->save($this->getFullpath($path), self::$quality);

        return $path;
    }

    /**
     * Delete avatar by path.
     *
     * @param  string $path
     *
     * @return
     */
    public function delete($path)
    {
        $fullPath = $this->getFullpath($path);

        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }

    /**
     * Create the avatar directory.
     *
     * @param  string $dir
     */
    protected function createDirectory($dir)
    {
        if (! is_dir(public_path() . '/' .$dir)) {
            mkdir($dir, 0777, true);
        }
    }
}
