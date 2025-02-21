@if(session('success'))
<div id="flash-message" class="alert alert-success border border-gray-800 bg-slate-500 text-white mt-32 p-1 rounded-xl">
    {{ session('success') }}
</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const flashMessage = document.getElementById('flash-message');

        if (flashMessage) {
            // Show message for 2 seconds before starting fade
            setTimeout(() => {
                // Add transition property for opacity
                flashMessage.style.transition = 'opacity 1s ease';
                flashMessage.style.opacity = '0';

                // Remove element after transition completes
                setTimeout(() => {
                    flashMessage.remove();
                }, 1000);
            }, 1000);
        }
    });
</script>