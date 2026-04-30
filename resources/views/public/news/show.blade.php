<x-core::layouts.public
    :title="$model->title . ' – ' . __('News') . ' – ' . websiteTitle()"
    :og-title="$model->title ?? ''"
    :description="$model->summary ?? ''"
    :og-image="$model->ogImageUrl()"
    :body-class="'body-news body-news-' . $model->id . ' body-page body-page-' . $page->id"
    :page="$page"
    :model="$model"
>
    <article class="news container-xl">
        <header class="news-header">
            <div class="news-header-container">
                <div class="news-header-navigator">
                    <x-core::items-navigator :$model :$page />
                </div>
                <h1 class="news-title">{{ $model->title }}</h1>
                <div class="news-date"><x-core::date-localized :date="$model->date" /></div>
            </div>
        </header>
        <div class="news-body">
            <x-core::json-ld :schema="[
                '@context' => 'https://schema.org',
                '@type' => 'NewsArticle',
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => $model->url(),
                ],
                'headline' => $model->title,
                'image' => [$model->image?->render()],
                'datePublished' => $model->date->toIso8601String(),
                'dateModified' => $model->updated_at->toIso8601String(),
                'author' => [
                    '@type' => 'Organization',
                    'name' => config('app.name'),
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => config('app.name'),
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => Vite::asset(config('typicms.logo')),
                    ],
                ],
                'description' => $model->summary ? $model->summary : Str::limit(strip_tags($model->body), 200),
            ]" />
            @if ($model->summary)
                <p class="news-summary">{!! nl2br($model->summary) !!}</p>
            @endif

            <x-core::share-links :$model />
            @if ($model->image)
                <figure class="news-picture">
                    <img class="news-picture-image" src="{{ $model->image->render(2000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="" />
                    @if ($model->image->description)
                        <figcaption class="news-picture-legend">{{ $model->image->description }}</figcaption>
                    @endif
                </figure>
            @endif

            @if ($model->body)
                <div class="rich-content">{!! $model->formattedBody() !!}</div>
            @endif

            @include('public::files._document-list')
            @include('public::files._image-list')
        </div>
    </article>
</x-core::layouts.public>
