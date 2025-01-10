<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Find Friends, Social Platform, Connect">
    <meta name="description" content="A platform to find and connect with friends who share similar hobbies.">
    
    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Core Stylesheets -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <!-- Page-specific CSS -->
    @stack('css')
    
    <title>ConnectFriend</title>
</head>

<body>
    <!-- Main Container -->
    <div class="wrapper bg-light">
        <!-- Header Section -->
        <header>
            @include('partials.navbar')
        </header>
        
        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
        
        <!-- Footer Section -->
        <footer>
            @include('partials.footer')
        </footer>
    </div>

    <!-- External Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert for Notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
    
    <!-- Page-specific Scripts -->
    @stack('scripts')
</body>

</html>
