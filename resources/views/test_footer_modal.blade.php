<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Footer Modal Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Footer Modal Test Page</h1>
        <p>This page is for testing the footer modal functionality.</p>
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#returnOrderModal">
            <i class="fas fa-undo-alt me-2"></i>
            Test Return/Cancel Order Modal
        </button>
        
        <div class="mt-3">
            <h3>Debug Information</h3>
            <p><strong>CSRF Token:</strong> <span id="csrf-token">{{ csrf_token() }}</span></p>
            <p><strong>Current URL:</strong> <span id="current-url"></span></p>
            <p><strong>API Endpoint:</strong> <a href="{{ url('/api/order/ORD-FJJS8ESZ') }}" target="_blank">{{ url('/api/order/ORD-FJJS8ESZ') }}</a></p>
            <p><strong>Submit Endpoint:</strong> {{ route('return-product.submit') }}</p>
        </div>
        
        <div class="mt-3">
            <h3>Console Logs</h3>
            <div id="console-logs" style="background: #f8f9fa; padding: 10px; border-radius: 5px; height: 200px; overflow-y: scroll;"></div>
        </div>
    </div>

    @include('frontend.DealerShowroom.layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Capture console logs
        const consoleDiv = document.getElementById('console-logs');
        const originalLog = console.log;
        const originalError = console.error;
        
        function addToConsole(type, args) {
            const logEntry = document.createElement('div');
            logEntry.className = type === 'error' ? 'text-danger' : 'text-info';
            logEntry.textContent = new Date().toLocaleTimeString() + ' [' + type.toUpperCase() + '] ' + Array.from(args).join(' ');
            consoleDiv.appendChild(logEntry);
            consoleDiv.scrollTop = consoleDiv.scrollHeight;
        }
        
        console.log = function(...args) {
            originalLog.apply(console, args);
            addToConsole('log', args);
        };
        
        console.error = function(...args) {
            originalError.apply(console, args);
            addToConsole('error', args);
        };
        
        // Update current URL
        document.getElementById('current-url').textContent = window.location.href;
        
        // Test API endpoint
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded successfully');
            console.log('CSRF token found:', document.querySelector('meta[name="csrf-token"]') ? 'Yes' : 'No');
            console.log('Modal element found:', document.getElementById('returnOrderModal') ? 'Yes' : 'No');
            console.log('Form element found:', document.getElementById('returnOrderForm') ? 'Yes' : 'No');
        });
    </script>
</body>
</html>
