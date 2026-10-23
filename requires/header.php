<?php

?>





    <header class="site-header">
       
      <div class="container header-top">
        <a class="brand" href="../index.php">
          <img
              src="../assets/img/logo-utu-transparent.png"
              alt="Escudo Escuela Técnica N.º 1"
              class="brand-crest-img">
          <div class="brand-text">
            <span class="brand-name" data-i18n="common.brand.name">Escuela Técnica N.º 1</span>
            <span class="brand-sub" data-i18n="common.brand.sub">"Mtro. Téc. Sergio G. Olaizola" · Bella Unión</span>
          </div>
        </a>
        <!-- Buscador del sitio (lo controla assets/js/buscador.js) -->
        <form class="header-search" id="search-form" role="search" autocomplete="off">
          <div class="search-field">
            <i class="bi bi-search" aria-hidden="true"></i>
            <label for="search-input" class="visually-hidden" data-i18n="common.nav.searchLabel">Buscar en el sitio</label>
            <input
                type="search"
                id="search-input"
                class="search-input"
                data-i18n="common.nav.searchPlaceholder"
                data-i18n-attr="placeholder"
                placeholder="Buscar en el sitio...">
            <button
                class="search-submit"
                type="submit"
                data-i18n="common.nav.searchBtn"
                data-i18n-attr="aria-label"
                aria-label="Buscar"><i class="bi bi-arrow-right"></i></button>
          </div>
          <ul class="search-results" id="search-results"></ul>
        </form>
        <!-- Botones de idioma y de tema claro/oscuro (i18n.js y theme.js) -->
        <div class="header-tools">
          <button class="tool-btn" id="lang-btn" type="button" aria-label="Cambiar idioma / Mudar idioma"><span class="flag-icon" aria-hidden="true"></span></button>
          <button
              class="tool-btn"
              id="theme-btn"
              type="button"
              data-i18n="common.theme.toggle"
              data-i18n-attr="aria-label"
              aria-label="Cambiar entre modo claro y oscuro"><i class="bi bi-moon-stars" aria-hidden="true"></i></button>
        </div>
      </div>
       
      <!-- Menú de navegación: Institución, Estudiantes, Anexos e Inscripciones -->
      <nav class="navbar navbar-expand-lg navbar-custom" aria-label="Navegación principal">
        <div class="container">
          <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#mainNavbar"
              aria-controls="mainNavbar"
              aria-expanded="false"
              data-i18n="common.nav.menuToggle"
              data-i18n-attr="aria-label"
              aria-label="Abrir menú"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    data-i18n="common.nav.institucion">Institución</a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="noticias.php" data-i18n="common.nav.noticias">Noticias</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="normativa.php" data-i18n="common.nav.normativa">Normativa</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    data-i18n="common.nav.estudiantes">Estudiantes</a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="cursos.php" data-i18n="common.nav.cursos">Cursos y Carreras</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="horarios.php" data-i18n="common.nav.horarios">Horarios y Exámenes</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="anexos.php" data-i18n="common.nav.anexos">Anexos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="inscripciones.php" data-i18n="common.nav.inscripciones">Inscripciones</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>