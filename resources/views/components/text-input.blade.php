@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'custom-input']) !!}>

<style>
    .custom-input {
        width: 100%;
        background: var(--glass-strong);
        border: 1px solid var(--platinum-line);
        border-radius: var(--radius-md);
        padding: 10px 14px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: var(--text-main);
        outline: none;
        transition: 0.3s;
    }
    .custom-input:focus {
        border-color: var(--emerald-mid);
        box-shadow: 0 0 0 3px rgba(168, 216, 200, 0.25);
    }
</style>