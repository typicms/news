<?php

declare(strict_types=1);

use TypiCMS\Modules\News\Models\News;

return [
    'model' => News::class,
    'linkable_to_page' => true,
    'has_feed' => true,
    'per_page' => 30,
    'llms_txt' => true,
    'order' => [
        'date' => 'desc',
    ],
    'sidebar' => [
        'icon' => '<i class="icon-newspaper"></i>',
        'weight' => 20,
    ],
    'permissions' => [
        'read news' => 'Read',
        'create news' => 'Create',
        'update news' => 'Update',
        'delete news' => 'Delete',
    ],
];
