<footer class="d-footer">
  <style>
  /* Style général du footer */
  .d-footer {
    background-color: #1a1a1a; /* Fond sombre */
    color: #ffffff;
    padding: 60px 20px;
    font-family: 'Arial', sans-serif;
  }

  /* Contenu du footer */
  .footer-content {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0;
  }

  /* Sections du footer */
  .footer-section {
    flex: 1;
    padding: 20px;
    min-width: 250px;
    margin-bottom: 30px;
  }

  /* Titres des sections */
  .footer-title {
    font-size: 1.2em;
    margin-bottom: 12px;
    color: #ffda40; /* Couleur d'accent jaune */
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  /* Logo */
  .footer-logo {
    width: 120px;
    margin-bottom: 20px;
  }

  /* Texte du footer */
  .footer-text {
    font-size: 0.9em;
    line-height: 1.6;
    color: #cccccc; /* Texte gris clair pour un meilleur contraste */
  }

  /* Section Contact */
  .contact span {
    display: block;
    margin: 10px 0;
    font-size: 0.9em;
    color: #cccccc;
  }

  .contact i {
    margin-right: 10px;
    color: #ffda40; /* Icônes en jaune */
  }

  /* Liens rapides */
  .footer-section.links ul {
    list-style: none;
    padding: 0;
  }

  .footer-section.links ul li {
    margin-bottom: 10px;
  }

  .footer-section.links ul li a {
    color: #cccccc;
    text-decoration: none;
    font-size: 0.9em;
    transition: color 0.3s ease;
  }

  .footer-section.links ul li a:hover {
    color: #ffda40; /* Couleur d'accent au survol */
  }

  /* Réseaux sociaux */
  .footer-section.social .social-links {
    display: flex;
    gap: 20px;
    justify-content: center;
  }

  .footer-section.social .social-links a {
    color: #cccccc;
    font-size: 1.5em;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .footer-section.social .social-links a:hover {
    color: #ffda40; /* Couleur d'accent au survol */
  }

  /* Section Copyright */
  .footer-bottom {
    text-align: center;
    padding: 20px 0;
    border-top: 1px solid #444;
    margin-top: 40px;
    font-size: 0.9em;
    color: #cccccc;
    letter-spacing: 1px;
  }

  /* Icônes sociales */
  .social-icon {
    display: inline-block;
    padding: 10px;
    background-color: #333;
    border-radius: 50%;
    transition: background-color 0.3s ease;
  }

  .social-icon:hover {
    background-color: #ffda40; /* Fond jaune au survol */
  }

  .social-icon i {
    color: #fff;
  }

  </style>

  <div class="footer-content">
    <!-- Section À propos -->
    <div class="footer-section about">
      <h2 class="footer-title">
        <img src="{{ asset('assets/Adlab-Logo-siteweb.png') }}" alt="Adlab-Factory Logo" class="footer-logo">
      </h2>
      <p class="footer-text">
        Adlab-Factory est une agence de communication et de marketing digital spécialisée dans la création de sites web et la conception graphique sur mesure.
        Agence digitale innovante offrant des solutions sur mesure pour améliorer votre marque en ligne.
      </p>
      <div class="contact">
        <span><i class="fas fa-phone"></i> +33 1 23 45 67 89</span>
        <span><i class="fas fa-envelope"></i> contact@adlabfactory.com</span>
      </div>
    </div>

    <!-- Section Liens rapides -->
    <div class="footer-section links">
      <h5 class="footer-title">LIENS UTILES</h5>
      <ul>
        <li><a href="#">a propos</a></li>
        <li><a href="#">contactez-nous</a></li>
        <li><a href="#">politique de confidentialité</a></li>
        <li><a href="#">Pricing</a></li>
        <li><a href="#">Réseaux Sociaux Packs</a></li>
      </ul>
    </div>
    <div class="footer-section links">
      <h5 class="footer-title">LIENS IMPORTANTS</h5>
      <ul>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Graphique Design</a></li>
        <li><a href="#">Site web oneshot</a></li>
      </ul>
    </div>
  </div>

  <!-- Section Copyright -->
  <div class="footer-bottom">
    &copy; 2025 AdLab Factory | Tous droits réservés
  </div>
</footer>

   





