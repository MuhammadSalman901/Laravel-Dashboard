<!-- order-btn.blade.php -->
<div class="relative mt-6">
    <button class="order-dropbtn w-full text-center py-1 hover:bg-gray-700 hover:pl-3 transition-all duration-300">Order</button>
    <div class="order-dropdown-content text-center  hidden absolute mt-1 w-full bg-gray-700">
        <a href="{{ url('order_list') }}" class="block py-2 hover:bg-gray-600">Show Orders</a>
        <!-- Redirect to SalesOrder creation first -->
        <a href="{{ route('sales_order.create') }}" class="block py-2 hover:bg-gray-600">Create Order</a>
    </div>
</div>
<script>
    // For Order dropdown 
    document.addEventListener('DOMContentLoaded', function() {
        const orderDropBtn = document.querySelector('.order-dropbtn');
        const orderDropContent = document.querySelector('.order-dropdown-content');

        // Optional: Click handler if you want to toggle on click as well as hover
        orderDropBtn.addEventListener('click', function(e) {
            e.preventDefault();
            orderDropContent.style.display = orderDropContent.style.display === 'block' ? 'none' : 'block';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!orderDropBtn.contains(e.target) && !orderDropContent.contains(e.target)) {
                orderDropContent.style.display = 'none';
            }
        });
    });
</script>