<?php

namespace Savannabits\Translatable\Test;

use Savannabits\Translatable\TranslatableFormRequest;
use Illuminate\Support\Collection;

class TestRequestWithRequiredLocales extends TranslatableFormRequest
{
    public function untranslatableRules()
    {
        return [
            'published_at' => ['required', 'datetime'],
        ];
    }

    public function translatableRules($locale)
    {
        return [
            'title' => ['required', 'string'],
            'body' => ['nullable', 'text'],
        ];
    }

    public function defineRequiredLocales() : Collection
    {
        return collect(['en', 'de']);
    }
}
