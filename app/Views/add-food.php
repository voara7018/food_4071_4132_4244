<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FoodSwipe — Ajouter un plat</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
</head>
<body>

<div class="app-page">

  <!-- Top Bar -->
  <div class="topbar">
    <span class="topbar-logo"><span>🍽️</span>FoodSwipe</span>
    <div class="topbar-actions">
      <a href="<?= base_url('logout') ?>" title="Se déconnecter">🚪</a>
    </div>
  </div>

  <!-- Form Body -->
  <div class="addfood-body">

    <!-- Preview Card -->
    <div class="preview-wrap">
      <div class="preview-label">Aperçu</div>
      <div class="preview-card" id="preview-card">
        <div class="preview-img" id="preview-img" style="background:linear-gradient(135deg,#FF6B6B22,#FF6B6B55)">
          <img id="preview-photo" src="" alt="" style="display:none;width:100%;height:100%;object-fit:cover;object-position:center" />
          <span id="preview-emoji">🍽️</span>
        </div>
        <div class="food-card-info">
          <div class="food-card-top">
            <div class="food-card-name" id="preview-name">Nom du plat</div>
            <div class="food-card-rating">⭐ <span id="preview-rating">-</span></div>
          </div>
          <div class="food-card-meta">
            <span class="badge category" id="preview-cat">Catégorie</span>
            <span class="badge time" id="preview-time">⏱ --</span>
            <span class="badge cal"  id="preview-cal">🔥 -- kcal</span>
          </div>
          <div class="food-card-desc" id="preview-desc">Description du plat…</div>
        </div>
      </div>
    </div>

    <!-- Form -->
    <!-- Ajout de l'action vers le controller et de l'enctype pour l'image -->
    <form class="addfood-form" action="<?= base_url('food/store') ?>" method="POST" enctype="multipart/form-data">
      
      <?= csrf_field() ?> <!-- Sécurité CI4 -->

      <!-- Image Upload -->
      <div class="form-group">
        <label>Photo du plat</label>
        <div class="upload-zone" id="upload-zone"
             onclick="document.getElementById('field-img').click()"
             ondragover="onDragOver(event)" ondragleave="onDragLeave(event)" ondrop="onDrop(event)">
          <!-- Ajout du name="image_file" -->
          <input type="file" id="field-img" name="image_file" accept="image/*" style="display:none" onchange="onImageUpload(event)" />
          <div class="upload-placeholder" id="upload-placeholder">
            <span class="upload-icon">📷</span>
            <p class="upload-text">Cliquer ou glisser une photo</p>
            <p class="upload-hint">JPG, PNG, WEBP · max 5 Mo</p>
          </div>
          <div class="upload-preview" id="upload-preview" style="display:none">
            <img id="upload-preview-img" src="" alt="Aperçu" />
            <button type="button" class="upload-remove" onclick="removeImage(event)" title="Supprimer la photo">✕</button>
          </div>
        </div>
      </div>

      <!-- Emoji Picker -->
      <div class="form-group">
        <label>Emoji du plat</label>
        <div class="emoji-grid" id="emoji-grid">
          <!-- injected by JS -->
        </div>
        <!-- Ajout du name="emoji" -->
        <input type="hidden" id="field-emoji" name="emoji" value="🍽️" />
      </div>

      <!-- Name -->
      <div class="form-group">
        <label>Nom du plat <span class="required">*</span></label>
        <input type="text" id="field-name" name="nom" placeholder="ex : Bœuf bourguignon" maxlength="40"
               oninput="syncPreview()" required />
      </div>

      <!-- Category -->
      <div class="form-group">
        <label>Catégorie <span class="required">*</span></label>
        <div class="select-wrap">
          <select id="field-cat" name="id_category" onchange="onCatChange()" required>
            <option value="">-- Choisir --</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= $cat['nom'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <!-- Time + Calories row -->
      <div class="form-row">
        <div class="form-group" style="flex:1">
          <label>Temps <span class="required">*</span></label>
          <div class="input-suffix-wrap">
            <input type="number" id="field-time" name="time" placeholder="30" min="1" max="999"
                   oninput="syncPreview()" required />
            <span class="input-suffix">min</span>
          </div>
        </div>
        <div class="form-group" style="flex:1">
          <label>Calories <span class="required">*</span></label>
          <div class="input-suffix-wrap">
            <input type="number" id="field-cal" name="calorie" placeholder="500" min="1" max="9999"
                   oninput="syncPreview()" required />
            <span class="input-suffix">kcal</span>
          </div>
        </div>
      </div>

      <!-- Rating -->
      <div class="form-group">
        <label>Note  <span class="required">*</span></label>
        <div class="star-row">
          <input type="range" id="field-rating" name="rating" min="1" max="5" step="0.1" value="4.0"
                 oninput="syncPreview()" />
          <div class="star-display">
            <span id="star-visual">★★★★☆</span>
            <span id="star-num" class="star-num">4.0</span>
          </div>
        </div>
      </div>

      <!-- Description -->
      <div class="form-group">
        <label>Description</label>
        <textarea id="field-desc" name="description" placeholder="Décrivez votre plat en quelques mots…"
                  rows="3" maxlength="140" oninput="syncPreview()"></textarea>
        <div class="char-count"><span id="char-count">0</span>/140</div>
      </div>

      <?php if(session()->getFlashdata('error')): ?>
        <p class="form-error visible"><?= session()->getFlashdata('error') ?></p>
      <?php endif; ?>

      <button type="submit" class="btn-primary">Ajouter le plat ✅</button>

    </form>

  </div>

  <!-- Bottom Nav -->
  <div class="bottom-nav">
    <a href="<?= base_url('home') ?>">
      <span class="nav-icon">🔥</span>Découvrir
    </a>
    <a href="<?= base_url('add-food') ?>" class="active">
      <span class="nav-icon">➕</span>Ajouter
    </a>
    <a href="<?= base_url('stats') ?>">
      <span class="nav-icon">📊</span>Mes stats
    </a>
  </div>

</div>

<!-- Success Toast -->
<div class="toast" id="toast">✅ Plat ajouté avec succès !</div>

<script>
  /* ── Emoji grid ── */
  const EMOJIS = [
    '🍕','🍔','🌮','🌯','🍜','🍝','🍣','🍱','🍛','🍲',
    '🥘','🍚','🥗','🍳','🥞','🧆','🥙','🫔','🍢','🍱',
    '🥩','🍗','🥚','🧀','🥓','🌭','🥪','🫕','🍮','🧁',
    '🎂','🍰','🍩','🍪','🍫','🍦','🍧','🍨','🥧','🍡',
    '🍷','🥂','🍺','🧋','🥤','☕','🍵','🥛','🍹','🧃',
  ];

  let selectedEmoji = '🍽️';
  let uploadedImageDataURL = null;

  /* ── Image upload ── */
  function onImageUpload(e) {
    const file = e.target.files[0];
    if (file) processImageFile(file);
  }

  function onDragOver(e) {
    e.preventDefault();
    document.getElementById('upload-zone').classList.add('drag-over');
  }

  function onDragLeave(e) {
    document.getElementById('upload-zone').classList.remove('drag-over');
  }

  function onDrop(e) {
    e.preventDefault();
    document.getElementById('upload-zone').classList.remove('drag-over');
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) processImageFile(file);
  }

  function processImageFile(file) {
    if (file.size > 5 * 1024 * 1024) {
      alert('L\'image dépasse 5 Mo.');
      return;
    }

    const reader = new FileReader();
    reader.onload = function(ev) {
      uploadedImageDataURL = ev.target.result;
      document.getElementById('upload-preview-img').src = uploadedImageDataURL;
      document.getElementById('upload-placeholder').style.display = 'none';
      document.getElementById('upload-preview').style.display    = 'block';
      syncPreview();
    };
    reader.readAsDataURL(file);
  }

  function removeImage(e) {
    e.stopPropagation();
    uploadedImageDataURL = null;
    document.getElementById('field-img').value = '';
    document.getElementById('upload-preview-img').src = '';
    document.getElementById('upload-preview').style.display    = 'none';
    document.getElementById('upload-placeholder').style.display = 'flex';
    syncPreview();
  }

  /* ── Build Emoji Grid ── */
  const grid = document.getElementById('emoji-grid');
  EMOJIS.forEach(em => {
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'emoji-btn';
    btn.textContent = em;
    btn.onclick = () => selectEmoji(em, btn);
    grid.appendChild(btn);
  });

  function selectEmoji(em, btn) {
    document.querySelectorAll('.emoji-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    selectedEmoji = em;
    document.getElementById('field-emoji').value = em;
    syncPreview();
  }

  function onCatChange() {
    syncPreview();
  }

  /* ── Live preview sync ── */
  function syncPreview() {
    const name    = document.getElementById('field-name').value.trim()  || 'Nom du plat';
    const sel     = document.getElementById('field-cat');
    const catText = sel.options[sel.selectedIndex].text || 'Catégorie';
    
    const time    = document.getElementById('field-time').value;
    const cal     = document.getElementById('field-cal').value;
    const rating  = parseFloat(document.getElementById('field-rating').value).toFixed(1);
    const desc    = document.getElementById('field-desc').value.trim()   || 'Description du plat…';

    const previewPhoto = document.getElementById('preview-photo');
    const previewEmoji = document.getElementById('preview-emoji');

    if (uploadedImageDataURL) {
      previewPhoto.src = uploadedImageDataURL;
      previewPhoto.style.display = 'block';
      previewEmoji.style.display = 'none';
    } else {
      previewPhoto.style.display = 'none';
      previewEmoji.style.display = 'block';
      previewEmoji.textContent = selectedEmoji;
    }

    document.getElementById('preview-name').textContent   = name;
    document.getElementById('preview-cat').textContent    = catText;
    document.getElementById('preview-time').textContent   = `⏱ ${time || '--'} min`;
    document.getElementById('preview-cal').textContent    = `🔥 ${cal  || '--'} kcal`;
    document.getElementById('preview-rating').textContent = rating;
    document.getElementById('preview-desc').textContent   = desc;

    const stars = Math.round(parseFloat(rating));
    document.getElementById('star-visual').textContent = '★'.repeat(stars) + '☆'.repeat(5 - stars);
    document.getElementById('star-num').textContent    = rating;

    const len = document.getElementById('field-desc').value.length;
    document.getElementById('char-count').textContent = len;
  }

  // Initialisation
  syncPreview();
</script>

</body>
</html>