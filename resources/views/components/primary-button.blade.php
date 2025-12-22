<button {{ $attributes->merge(['type' => 'submit', 'class' => 'custom-primary-btn']) }}>
    {{ $slot }}
</button>

<style>
    .custom-primary-btn {
        background: var(--emerald-deep);
        color: white;
        padding: 10px 24px;
        border-radius: 999px;
        border: none;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: var(--shadow-subtle);
    }
    .custom-primary-btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }
</style>