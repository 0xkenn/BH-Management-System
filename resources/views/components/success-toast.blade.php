@props([
    'message'
])

<div role="alert" class="fixed top-4 right-4 p-6 bg-green-500 text-white rounded shadow-lg flex items-center space-x-2" id="success-alert">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span>{{$message}}</span>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var alert = document.getElementById('success-alert');
        if (alert) {
            setTimeout(function () {
                alert.style.opacity = '0'; // Fade out effect
                setTimeout(function () {
                    alert.style.display = 'none'; // Hide element after fade out
                }, 600); // Time to wait for fade out
            }, 5000); // Time to display the alert (5 seconds)
        }
    });
    </script>