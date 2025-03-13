<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Login to Your Account</h1>
        
        <!-- Success Message -->
        <div id="success-alert" class="mb-4 {{ !session('success') ? 'hidden' : '' }}">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                <p id="success-message">{{ session('success') }}</p>
            </div>
        </div>

        <!-- Login Form -->
        <form id="login-form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input type="email" id="email" name="email" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500"
                    placeholder="your@email.com">
                <p id="email-error" class="text-red-500 text-xs italic hidden">Please enter a valid email address.</p>
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500"
                        placeholder="******************">
                    <button type="button" id="toggle-password" class="absolute right-0 top-0 mt-2 mr-3 text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <p id="password-error" class="text-red-500 text-xs italic hidden">Please enter your password.</p>
            </div>
            
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <input id="remember-me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Forgot password?</a>
            </div>
            
            <div class="flex items-center justify-center">
                <button id="login-button" type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full transition duration-300 flex items-center justify-center">
                    <span>Login</span>
                    <span id="loading-spinner" class="ml-2 hidden">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>
            </div>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">Sign up</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('login-form');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const togglePasswordButton = document.getElementById('toggle-password');
            const loginButton = document.getElementById('login-button');
            const loadingSpinner = document.getElementById('loading-spinner');
            const successAlert = document.getElementById('success-alert');
            
            // Email validation
            emailInput.addEventListener('blur', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value) && emailInput.value !== '') {
                    emailError.classList.remove('hidden');
                    emailInput.classList.add('border-red-500');
                } else {
                    emailError.classList.add('hidden');
                    emailInput.classList.remove('border-red-500');
                }
            });
            
            // Password toggle visibility
            togglePasswordButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Update the icon based on password visibility
                if (type === 'text') {
                    togglePasswordButton.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    `;
                } else {
                    togglePasswordButton.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    `;
                }
            });
            
            // Form submission with validation
            form.addEventListener('submit', function(event) {
                let isValid = true;
                
                if (!emailInput.value) {
                    emailError.textContent = 'Email is required';
                    emailError.classList.remove('hidden');
                    emailInput.classList.add('border-red-500');
                    isValid = false;
                }
                
                if (!passwordInput.value) {
                    passwordError.textContent = 'Password is required';
                    passwordError.classList.remove('hidden');
                    passwordInput.classList.add('border-red-500');
                    isValid = false;
                }
                
                if (isValid) {
                    // Show loading spinner
                    loadingSpinner.classList.remove('hidden');
                    loginButton.querySelector('span:first-child').textContent = 'Logging in...';
                    loginButton.disabled = true;
                    
                    // Here the form will submit naturally
                } else {
                    event.preventDefault();
                }
            });
            
            // Auto-hide success message after 5 seconds
            if (successAlert && !successAlert.classList.contains('hidden')) {
                setTimeout(function() {
                    successAlert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                    setTimeout(function() {
                        successAlert.classList.add('hidden');
                    }, 500);
                }, 5000);
            }
        });
    </script>
</body>
</html>