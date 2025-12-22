<button {{ $attributes->merge(['type' => 'submit', 'class' => 'custom-danger-btn']) }}>
    {{ $slot }}
</button>

<style>
    .custom-danger-btn {
        background: #b03a2e !important;
        color: white !important;
        padding: 12px 30px !important;
        border-radius: 999px !important;
        border: none !important;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(176, 58, 46, 0.3);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .custom-danger-btn:hover {
        background: #8e2e25 !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(176, 58, 46, 0.4);
    }
</style>