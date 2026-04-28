<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FoodSwipe — Connexion</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

<div class="auth-page">
  <div class="auth-card">

    <div class="auth-logo">
      <span class="logo-icon">🍽️</span>
      <h1>FoodSwipe</h1>
      <p>Swipez. Savourez. Régalez-vous.</p>
    </div>

  <form action="/login" method="post" id="login-form">
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" id="login-email" placeholder="vous@exemple.com" autocomplete="email" />
      <div><?= $validation['email'] ?? '' ?></div>
    </div>

    <div class="form-group">
      <label>Mot de passe</label>
      <input type="password" name="password" id="login-pwd" placeholder="••••••••" autocomplete="current-password" />
      <div><?= $validation['password'] ?? '' ?></div>
    </div>

    <p class="form-error" id="reg-error"></p>

    <button class="btn-primary" type="submit">Se connecter 🍴</button>

    <div class="auth-switch">
      Pas encore de compte ? <a href="/register">S'inscrire</a>
    </div>

  </div>
</div>


</body>
</html>
