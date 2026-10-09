<x-layouts.app>

    <x-slot:breadcrumb>
        <li><a href="/category/{{ $category->id }}/{{ $category->slug }}/" title="{{ $category->name }}">{{ $category->name }}</a></li>
        <li><a href="/category/{{ $category->id }}/{{ $category->slug }}/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" title="{{ $brand->name }}">{{ $brand->name }}</a></li>
    </x-slot:breadcrumb>

    <h1>{{ $brand->name }} - {{ $category->name }}</h1>

    <p>{{ __('introduction_texts.type_list', ['brand' => $brand->name]) }}</p>

    <div class="row type-grid">
        @foreach ($manuals as $manual)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="type-grid-item">
                    <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" title="{{ $manual->name }}">{{ $manual->name }}</a>
                </div>
            </div>
        @endforeach
    </div>

</x-layouts.app>
