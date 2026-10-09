<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="{{ __('site.manuals_for', ['brand' => $brand->name]) }}" title="{{ __('site.manuals_for', ['brand' => $brand->name]) }}">{{ $brand->name }}</a></li>
    </x-slot:breadcrumb>


    <h1>{{ $brand->name }}</h1>

    <p>{{ __('introduction_texts.type_list', ['brand'=>$brand->name]) }}</p>

    <section id="popular-manuals">
        <h2>{{ __('introduction_texts.popular_manuals') }}</h2>
        <ol class="popular-manual-list">
            @foreach ($popularManuals as $manual)
                <li>
                    <span class="popular-manual-rank">{{ $loop->iteration }}.</span>
                    <div class="popular-manual-item">
                        <a class="popular-manual-link" href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" title="{{ $manual->name }}">{{ $manual->name }}</a>
                        <span class="popular-manual-views">{{ __('introduction_texts.manual_views', ['count' => $manual->view_count]) }}</span>
                    </div>
                </li>
            @endforeach
        </ol>
    </section>

    <section id="all-manuals">
        <h2>{{ __('introduction_texts.all_manuals') }}</h2>
        <div class="row type-grid">
        @foreach ($manuals as $manual)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="type-grid-item">
                    <a class="manual-link-button" href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" title="{{ $manual->name }}">{{ $manual->name }}</a>
                    @if ($manual->locally_available)
                        <small>({{$manual->filesize_human_readable}})</small>
                    @endif
                </div>
            </div>
        @endforeach
        </div>
    </section>

</x-layouts.app>
