<x-layouts.app>

    <x-slot:introduction_text>
        <div class="homepage-intro">
            <p>{{ $name }} {{ $surname }}</p>
            <p><img src="img/afbl_logo.png" align="right" width="100" height="100">{{ __('introduction_texts.homepage_line_1') }}</p>
            <p>{{ __('introduction_texts.homepage_line_2') }}</p>
            <p>{{ __('introduction_texts.homepage_line_3') }}</p>
        </div>
    </x-slot:introduction_text>

    <h2>{{ __('site.categories') }}</h2>
    <div class="row type-grid">
        @foreach($categories as $category)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="type-grid-item">
                    <a href="/category/{{ $category->id }}/{{ $category->slug }}/" title="{{ $category->name }}">{{ $category->name }}</a>
                </div>
            </div>
        @endforeach
    </div>

    <h2>{{ __('site.most_viewed_manuals') }}</h2>
    <ol class="popular-manual-list">
        @foreach($popularManuals as $manual)
            <li>
                <span class="popular-manual-rank">{{ $loop->iteration }}.</span>
                <a class="popular-manual" href="/{{ $manual->brand_id }}/{{ $manual->brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/">
                    {{ $manual->brand->name }}: {{ $manual->name }}
                </a>
            </li>
        @endforeach
    </ol>

    <h1>
        <x-slot:title>
            {{ __('misc.all_brands') }}
        </x-slot:title>
    </h1>


    @php
        $brandsByLetter = $brands->groupBy(fn ($brand) => strtoupper(substr($brand->name, 0, 1)));
        $lettersPerColumn = max(1, (int) ceil($brandsByLetter->count() / 3));
    @endphp

    <nav class="brand-alphabet" aria-label="Merken op letter">
        @foreach(range('A', 'Z') as $letter)
            @if($brandsByLetter->has($letter))
                <a class="brand-letter" href="#brand-{{ $letter }}">{{ $letter }}</a>
            @else
                <span class="brand-letter brand-letter-disabled" aria-disabled="true">{{ $letter }}</span>
            @endif
        @endforeach
    </nav>

    <div class="container brand-list">
        <div class="row">
            @foreach($brandsByLetter->chunk($lettersPerColumn) as $chunk)
                <div class="col-md-4">
                    @foreach($chunk as $letter => $letterBrands)
                        <h2 id="brand-{{ $letter }}">{{ $letter }}</h2>
                        <ul>
                            @foreach($letterBrands as $brand)
                                <li>
                                    <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">{{ $brand->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
