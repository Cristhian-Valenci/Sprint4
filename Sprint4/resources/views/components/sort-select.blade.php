<form method="GET" class="w-full flex justify-center">
    <select name="{{ $name ?? 'orden' }}" class="border rounded px-5 py-1 bg-gray-200" onchange="this.form.submit()">
        @foreach ($options ?? [] as $value => $label)
            <option value="{{ $value }}" {{ ($orden ?? '') == $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
</form>
