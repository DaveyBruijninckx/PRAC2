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
    <p><a class="btn btn-primary" href="{{ route('categories') }}">{{ __('site.view_all_categories') }}</a></p>

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

    <h2>Handleidingen</h2>

    <p>{{ __('site.brand_letter_intro') }}</p>

    <nav class="brand-alphabet" aria-label="Merken op letter">
        @foreach(range('A', 'Z') as $letter)
            @if($availableBrandLetters->contains($letter))
                <a class="brand-letter" href="{{ route('brands.by-letter', ['letter' => $letter]) }}">{{ $letter }}</a>
            @else
                <span class="brand-letter brand-letter-disabled" aria-disabled="true">{{ $letter }}</span>
            @endif
        @endforeach
    </nav>
</x-layouts.app>
