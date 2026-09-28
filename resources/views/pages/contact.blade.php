<x-layouts.app>

    <x-slot:breadcrumb>
        <li><a href="/contact/" title="Contact">Contact</a></li>
    </x-slot:breadcrumb>

    <h1>Contact</h1>

    <p>Heb je een vraag of opmerking? Vul het formulier hieronder in.</p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="/contact/" class="contact-form">
        @csrf

        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="message">Bericht</label>
            <textarea id="message" name="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Versturen</button>
    </form>

</x-layouts.app>
