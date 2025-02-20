<script
    type="module"
    src="https://unpkg.com/@material-tailwind/html@latest/scripts/popover.js"></script>

<table class="w-full border-collapse bg-white shadow-lg rounded-lg overflow-hidden font-sans">
    <thead>
        <tr>
            {{ $headers }}
        </tr>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>