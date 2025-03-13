<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Create Your Account</h1>
        
        <!-- Success Message -->
        <div id="success-alert" class="mb-4 {{ !session('success') ? 'hidden' : '' }}">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                <p id="success-message">{{ session('success') }}</p>
            </div>
        </div>

        <!-- Registration Form -->
        <form id="register-form" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                <input type="text" id="name" name="name" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500"
                    placeholder="your name">
                <p id="name-error" class="text-red-500 text-xs italic hidden">Please enter your name.</p>
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input type="email" id="email" name="email" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500"
                    placeholder="your@email.com">
                <p id="email-error" class="text-red-500 text-xs italic hidden">Please enter a valid email address.</p>
            </div>
            
            <div class="mb-4">
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
                <p id="password-error" class="text-red-500 text-xs italic hidden">Password must be at least 8 characters.</p>
                <div id="password-strength" class="mt-2 hidden">
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-red-500 h-2.5 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Password strength: <span id="strength-text">Weak</span></p>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500"
                    placeholder="******************">
                <p id="confirm-error" class="text-red-500 text-xs italic hidden">Passwords do not match.</p>
            </div>
            
            <div class="mb-4">
                <div class="flex items-center">
                    <input id="terms" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                    <label for="terms" class="ml-2 block text-sm text-gray-900">I agree to the <a href="#" class="text-blue-600 hover:underline">Terms of Service</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a></label>
                </div>
                <p id="terms-error" class="text-red-500 text-xs italic hidden">You must agree to the terms and conditions.</p>
            </div>
            
            <div class="flex items-center justify-center">
                <button id="register-button" type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full transition duration-300 flex items-center justify-center">
                    <span>Create Account</span>
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
            <p class="text-sm text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">Login</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('register-form');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirmation');
            const termsCheckbox = document.getElementById('terms');
            const nameError = document.getElementById('name-error');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const confirmError = document.getElementById('confirm-error');
            const termsError = document.getElementById('terms-error');
            const togglePasswordButton = document.getElementById('toggle-password');
            const registerButton = document.getElementById('register-button');
            const loadingSpinner = document.getElementById('loading-spinner');
            const successAlert = document.getElementById('success-alert');
            const passwordStrength = document.getElementById('password-strength');
            const strengthBar = document.querySelector('#password-strength .bg-red-500');
            const strengthText = document.getElementById('strength-text');
            
            // Name validation
            nameInput.addEventListener('blur', function() {
                if (nameInput.value.trim().length < 2) {
                    nameError.classList.remove('hidden');
                    nameInput.classList.add('border-red-500');
                } else {
                    nameError.classList.add('hidden');
                    nameInput.classList.remove('border-red-500');
                }
            });
            
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
            
            // Password strength checker
            passwordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                let strength = 0;
                
                if (password.length >= 8) strength += 25;
                if (password.match(/[A-Z]+/)) strength += 25;
                if (password.match(/[0-9]+/)) strength += 25;
                if (password.match(/[!@#$%^&*(),.?":{}|<>]+/)) strength += 25;
                
                passwordStrength.classList.remove('hidden');
                strengthBar.style.width = strength + '%';
                
                // Change color based on strength
                if (strength <= 25) {
                    strengthBar.className = 'bg-red-500 h-2.5 rounded-full';
                    strengthText.textContent = 'Weak';
                } else if (strength <= 50) {
                    strengthBar.className = 'bg-orange-500 h-2.5 rounded-full';
                    strengthText.textContent = 'Fair';
                } else if (strength <= 75) {
                    strengthBar.className = 'bg-yellow-500 h-2.5 rounded-full';
                    strengthText.textContent = 'Good';
                } else {
                    strengthBar.className = 'bg-green-500 h-2.5 rounded-full';
                    strengthText.textContent = 'Strong';
                }
                
                if (password.length < 8) {
                    passwordError.classList.remove('hidden');
                    passwordInput.classList.add('border-red-500');
                } else {
                    passwordError.classList.add('hidden');
                    passwordInput.classList.remove('border-red-500');
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
            
            // Confirm password validation
            confirmInput.addEventListener('blur', function() {
                if (confirmInput.value !== passwordInput.value) {
                    confirmError.classList.remove('hidden');
                    confirmInput.classList.add('border-red-500');
                } else {
                    confirmError.classList.add('hidden');
                    confirmInput.classList.remove('border-red-500');
                }
            });
            
            // Form submission with validation
            form.addEventListener('submit', function(event) {
                let isValid = true;
                
                // Validate name
                if (nameInput.value.trim().length < 2) {
                    nameError.textContent = 'Name is required (minimum 2 characters)';
                    nameError.classList.remove('hidden');
                    nameInput.classList.add('border-red-500');
                    isValid = false;
                }
                
                // Validate email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value)) {
                    emailError.textContent = 'A valid email address is required';
                    emailError.classList.remove('hidden');
                    emailInput.classList.add('border-red-500');
                    isValid = false;
                }
                
                // Validate password
                if (passwordInput.value.length < 8) {
                    passwordError.textContent = 'Password must be at least 8 characters';
                    passwordError.classList.remove('hidden');
                    passwordInput.classList.add('border-red-500');
                    isValid = false;
                }
                
                // Validate confirm password
                if (confirmInput.value !== passwordInput.value) {
                    confirmError.textContent = 'Passwords do not match';
                    confirmError.classList.remove('hidden');
                    confirmInput.classList.add('border-red-500');
                    isValid = false;
                }
                
                // Validate terms checkbox
                if (!termsCheckbox.checked) {
                    termsError.classList.remove('hidden');
                    isValid = false;
                } else {
                    termsError.classList.add('hidden');
                }
                
                if (isValid) {
                    // Show loading spinner
                    loadingSpinner.classList.remove('hidden');
                    registerButton.querySelector('span:first-child').textContent = 'Creating account...';
                    registerButton.disabled = true;
                    
                    // Form will submit naturally
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