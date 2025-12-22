@props(['value'])

<label {{ $attributes->merge(['class' => 'custom-label']) }}>
    {{ $value ?? $slot }}
</label>

<style>
    .custom-label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-main);
        margin-bottom: 6px;
    }
</style>