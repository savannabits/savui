<?php

return [

    /*
     * Language lines will be fetched by these loaders. You can put any class here that implements
     * the Savannabits\AdminTranslations\TranslationLoaders\TranslationLoader-interface.
     */
    'translation_loaders' => [
        Savannabits\AdminTranslations\TranslationLoaders\Db::class,
    ],

    /*
     * This is the model used by the Db Translation loader. You can put any model here
     * that extends Savannabits\AdminTranslations\Translation.
     */
    'model' => Savannabits\AdminTranslations\Translation::class,

    /*
     * This is the translation manager which overrides the default Laravel `translation.loader`
     */
    'translation_manager' => Savannabits\AdminTranslations\TranslationLoaderManager::class,

    /*
     * This option controls if package routes are used or not
     */
    'use_routes' => true,

    'scanned_directories' => [
        app_path(),
        resource_path('views'),
        // here you can add your own directories
    ],

];
