<?php
include "../modele/estConnecte.php";
if(est_connect()) {
    header("Location:../vue/accueil.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Aziz Auto - Connexion</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    max-width: 1200px;
    width: 100%;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    min-height: 600px;
}

.login-card {
    padding: 60px 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.login-header {
    text-align: center;
    margin-bottom: 40px;
}

.logo {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    margin-bottom: 10px;
}

.logo i {
    font-size: 2.5rem;
    color: #667eea;
}

.logo h1 {
    font-size: 2.2rem;
    color: #333;
    font-weight: 700;
}

.subtitle {
    color: #666;
    font-size: 1.1rem;
    font-weight: 300;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.form-group {
    position: relative;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon {
    position: absolute;
    left: 20px;
    color: #999;
    font-size: 1.1rem;
    z-index: 2;
}

.form-input {
    width: 100%;
    padding: 18px 20px 18px 55px;
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.form-input:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-input::placeholder {
    color: #999;
}

.toggle-password {
    position: absolute;
    right: 20px;
    cursor: pointer;
    color: #999;
    transition: color 0.3s ease;
}

.toggle-password:hover {
    color: #667eea;
}

.error-message {
    display: none;
    color: #e74c3c;
    font-size: 0.9rem;
    margin-top: 8px;
    margin-left: 5px;
}

.error-message.show {
    display: block;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 10px 0;
}

.remember-me {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 0.9rem;
    color: #666;
}

.remember-me input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 18px;
    height: 18px;
    border: 2px solid #ddd;
    border-radius: 4px;
    margin-right: 8px;
    position: relative;
    transition: all 0.3s ease;
}

.remember-me input:checked + .checkmark {
    background: #667eea;
    border-color: #667eea;
}

.remember-me input:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    color: white;
    font-size: 12px;
    top: -2px;
    left: 2px;
}

.forgot-password {
    color: #667eea;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.forgot-password:hover {
    color: #5a6fd8;
    text-decoration: underline;
}

.login-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 18px 30px;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
}

.login-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.login-btn:active {
    transform: translateY(0);
}

.btn-icon {
    transition: transform 0.3s ease;
}

.login-btn:hover .btn-icon {
    transform: translateX(5px);
}

.loading {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    color: #667eea;
    font-weight: 500;
    margin-top: 20px;
}

.decoration-image {
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.decoration-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.8;
}

.image-overlay {
    position: absolute;
    bottom: 50px;
    left: 50px;
    right: 50px;
    color: white;
    text-align: center;
}

.image-overlay h3 {
    font-size: 1.8rem;
    margin-bottom: 10px;
    font-weight: 600;
}

.image-overlay p {
    font-size: 1.1rem;
    opacity: 0.9;
}

/* Responsive Design */
@media (max-width: 768px) {
    .login-container {
        grid-template-columns: 1fr;
        max-width: 400px;
    }
    
    .decoration-image {
        display: none;
    }
    
    .login-card {
        padding: 40px 30px;
    }
    
    .logo h1 {
        font-size: 1.8rem;
    }
    
    .form-options {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
}

@media (max-width: 480px) {
    body {
        padding: 10px;
    }
    
    .login-card {
        padding: 30px 20px;
    }
    
    .logo {
        flex-direction: column;
        gap: 10px;
    }
    
    .logo h1 {
        font-size: 1.5rem;
    }
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-card {
    animation: fadeInUp 0.6s ease-out;
}

.form-group {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-options { animation: fadeInUp 0.6s ease-out 0.3s both; }
.login-btn { animation: fadeInUp 0.6s ease-out 0.4s both; }

    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Logo et titre -->
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-car"></i>
                    <h1>AZIZ AUTO</h1>
                </div>
                <p class="subtitle">Connectez-vous à votre espace</p>
            </div>

            <!-- Formulaire de connexion -->
            <form class="login-form" id="loginForm">
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input 
                            type="text" 
                            id="pseudo" 
                            class="form-input" 
                            placeholder="Nom d'utilisateur"
                            required
                        >
                    </div>
                    <span class="error-message" id="error_pseudo">Pseudo invalide !</span>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            id="pwd" 
                            class="form-input" 
                            placeholder="Mot de passe"
                            required
                        >
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                    <span class="error-message" id="error_pwd">Mot de passe invalide !</span>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" id="remember">
                        <span class="checkmark"></span>
                        Se souvenir de moi
                    </label>
                    <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                </div>

                <button type="button" class="login-btn" id="btn" onclick="seConnecter()">
                    <span class="btn-text">Se connecter</span>
                    <i class="fas fa-arrow-right btn-icon"></i>
                </button>
            </form>

            <!-- Message de chargement -->
            <div class="loading" id="loading" style="display: none;">
                <i class="fas fa-spinner fa-spin"></i>
                <span>Connexion en cours...</span>
            </div>
        </div>

        <!-- Image décorative -->
        <div class="decoration-image">
            <img src="img/azuz.jpg" alt="Aziz Auto" />
            <div class="image-overlay">
                <h3>Bienvenue chez Aziz Auto</h3>
                <p>Votre partenaire automobile de confiance</p>
            </div>
        </div>
    </div>

    <script src="./js/jquery.js"></script>
    <script src="../controller/index.js"></script>
    <script >
        document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('pwd');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }
    
    // Input focus effects
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.parentElement.classList.remove('focused');
            }
        });
    });
    
    // Form validation
    function showError(inputId, show = true) {
        const errorElement = document.getElementById(`error_${inputId}`);
        const inputElement = document.getElementById(inputId);
        
        if (errorElement && inputElement) {
            if (show) {
                errorElement.classList.add('show');
                inputElement.style.borderColor = '#e74c3c';
            } else {
                errorElement.classList.remove('show');
                inputElement.style.borderColor = '#e1e5e9';
            }
        }
    }
    
    // Clear errors on input
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const inputId = this.id;
            showError(inputId, false);
        });
    });
    
    // Loading state management
    window.showLoading = function(show = true) {
        const loading = document.getElementById('loading');
        const btn = document.getElementById('btn');
        
        if (loading && btn) {
            if (show) {
                loading.style.display = 'flex';
                btn.disabled = true;
                btn.style.opacity = '0.7';
            } else {
                loading.style.display = 'none';
                btn.disabled = false;
                btn.style.opacity = '1';
            }
        }
    };
    
    // Expose error function globally
    window.showError = showError;
});

    </script>
</body>
</html>
