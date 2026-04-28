<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FoodSwipe — Inscription</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

<div class="auth-page">
  <div class="auth-card">

    <div class="auth-logo">
      <span class="logo-icon">🥘</span>
      <h1>Créer un compte</h1>
      <p>Rejoignez la communauté des gourmands</p>
    </div>
  <form action="/register" method="post" id="register-form">
    <div class="form-group">
      <label>Prénom &amp; Nom</label>
      <input type="text" id="reg-name" name="username" placeholder="Jean Dupont" autocomplete="username" />
      <div><?= $validation['username'] ?? '' ?></div>
    </div>
    
    <div class="form-group">
      <label>Email</label>
      <input type="email" id="reg-email" name="email" placeholder="vous@exemple.com" autocomplete="email" />
      <div><?= $validation['email'] ?? '' ?></div>
    </div>
    
    <div class="form-group">
      <label>Mot de passe</label>
      <input type="password" id="reg-pwd" name="password" placeholder="8 caractères minimum" autocomplete="new-password" />
      <div><?= $validation['password'] ?? '' ?></div>
    </div>
    
    <div class="form-group">
      <label>Confirmer le mot de passe</label>
      <input type="password" id="reg-pwd2" name="password_confirm" placeholder="••••••••" autocomplete="new-password" />
      <div><?= $validation['password_confirm'] ?? '' ?></div>
    </div>
    
    <p class="form-error" id="reg-error"></p>
    
    <button class="btn-primary" type="submit">Créer mon compte 🎉</button>
    
    <div class="auth-switch">
      Déjà un compte ? <a href="/">Se connecter</a>
    </div>
    
  </form>
  </div>
</div>

</body>
</html>
