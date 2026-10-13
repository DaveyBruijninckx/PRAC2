<x-layouts.app>
    <x-slot:breadcrumb>
        <li><a href="/" title="{{ __('misc.all_brands') }}">{{ __('misc.all_brands') }}</a></li>
        <li>{{ $letter }}</li>
    </x-slot:breadcrumb>

    <h1>{{ __('misc.all_brands') }} - {{ $letter }}</h1>

    <ul class="brand-list brand-list-grid">
        @foreach ($brands as $brand)
            <li>
                <a class="brand-list-button" href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">{{ $brand->name }}</a>
            </li>
        @endforeach
    </ul>
</x-layouts.app>
