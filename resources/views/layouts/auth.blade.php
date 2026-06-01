<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#3B82F6">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <title>Login - Aplikasi Ritel</title>
    
    {{-- PWA Manifest --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('icon-192.png') }}">
    
    {{-- Favicon untuk semua device --}}
    <link rel="icon" type="image/png" sizes="72x72" href="{{ asset('icon-72.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('icon-96.png') }}">
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('icon-128.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('icon-192.png') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .btn-primary {
            background-color: #2563eb;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        .input-field {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            outline: none;
        }
        .input-field:focus {
            ring: 2px solid #3b82f6;
            border-color: transparent;
        }
        /* Hide install button initially */
        #install-pwa {
            display: none;
        }
        #install-pwa.show {
            display: block;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-500 to-purple-600">
    @yield('content')
    
    {{-- Service Worker Registration --}}
    <script>
        // Register Service Worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('Service Worker registered with scope:', registration.scope);
                    })
                    .catch(error => {
                        console.log('Service Worker registration failed:', error);
                    });
            });
        }
        
        // PWA Install Prompt
        let deferredPrompt;
        
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            const installBtn = document.getElementById('install-pwa');
            if (installBtn) {
                installBtn.classList.add('show');
            }
        });
        
        // Handle install button click
        window.installPWA = async function() {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    console.log('PWA installed successfully');
                }
                deferredPrompt = null;
                const installBtn = document.getElementById('install-pwa');
                if (installBtn) {
                    installBtn.classList.remove('show');
                }
            }
        }
    </script>
</body>
</html>