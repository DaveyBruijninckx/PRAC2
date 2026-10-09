<x-layouts.app>

    <x-slot:breadcrumb>
        <li><a href="/category/{{ $category->id }}/{{ $category->slug }}/" title="{{ $category->name }}">{{ $category->name }}</a></li>
    </x-slot:breadcrumb>

    <h1>{{ $category->name }}</h1>

    <p>{{ __('site.category_brands_intro', ['category' => $category->name]) }}</p>

    <div class="row type-grid">
        @foreach ($brands as $brand)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="type-grid-item">
                    <a href="/category/{{ $category->id }}/{{ $category->slug }}/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" title="{{ $brand->name }}">{{ $brand->name }}</a>
                </div>
            </div>
        @endforeach
    </div>

</x-layouts.app>
