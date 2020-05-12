<?php

namespace Savannabits\Media\Test;

use Savannabits\Media\HasMedia\HasMediaCollectionsTrait;
use Savannabits\Media\HasMedia\HasMediaThumbsTrait;
use Savannabits\Media\HasMedia\ProcessMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class TestModel extends Model implements HasMedia
{
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;
    use ProcessMediaTrait;

    public $timestamps = false;
    protected $table = 'test_models';
    protected $guarded = [];

    /**
     * Media collections
     *
     */
    public function registerMediaCollections(): void
    {
    }

    /**
     * Register the conversions that should be performed.
     *
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null): void
    {
    }
}
