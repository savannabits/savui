<?php

namespace Savannabits\Media\Exceptions\FileCannotBeAdded;

use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded;

class FileIsTooBig extends FileCannotBeAdded
{
    /**
     * @param string $file
     * @param float $maxSize
     * @param string $collectionName
     * @return FileIsTooBig
     */
    public static function create(string $file, float $maxSize, string $collectionName): FileIsTooBig
    {
        $actualFileSize = filesize($file);

        return new static(trans('savannabits/media::media.exceptions.thumbs_does_not_exists',
            ['actualFileSize' => $actualFileSize, 'collectionName' => $collectionName, 'maxSize' => $maxSize]));
    }
}
