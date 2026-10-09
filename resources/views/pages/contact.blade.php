<x-layouts.app>

    <x-slot:breadcrumb>
        <li><a href="/contact/" title="{{ __('site.contact') }}">{{ __('site.contact') }}</a></li>
    </x-slot:breadcrumb>

    <h1>{{ __('site.contact') }}</h1>

    <p>{{ __('site.contact_intro') }}</p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="/contact/" class="contact-form">
        @csrf

        <div class="form-group">
            <label for="name">{{ __('site.name') }}</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">{{ __('site.email') }}</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="message">{{ __('site.message') }}</label>
            <textarea id="message" name="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('site.send') }}</button>
    </form>

</x-layouts.app>
