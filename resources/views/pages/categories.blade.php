<x-layouts.app>
    <x-slot:breadcrumb>
        <li>{{ __('site.categories') }}</li>
    </x-slot:breadcrumb>

    <h1>{{ __('site.categories') }}</h1>

    <div class="row type-grid">
        @foreach ($categories as $category)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="type-grid-item">
                    <a href="/category/{{ $category->id }}/{{ $category->slug }}/" title="{{ $category->name }}">{{ $category->name }}</a>
                </div>
            </div>
        @endforeach
    </div>
</x-layouts.app>
