<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>EasyParki - Recherche de lieux</title>

    <!-- Favicons -->
    <link href="assets/img/logoo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">

    <style>

:root {
  --primary-color: #0d3f72;       
  --primary-dark: #08284d;        
  --secondary-color: #0a1d37;    
  --accent-color: #3a5cb3;        /* Bleu vif */
  --light-color: #f8fafc;         /* Fond très légèrement bleuté */
  --dark-color: #2d3748;          /* Texte foncé doux */
  --text-color: #4a5568;          /* Texte principal */
  --section-bg: #f5f7fa;          /* Arrière-plan des sections */
  --card-bg: #ffffff;             /* Fond des cartes */
  --border-color: rgba(0,0,0,0.08); /* Bordures subtiles */
  --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
}
    
    /* Header & Navigation */
    .header {
      background: rgba(255, 255, 255, 0.98);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
    }
    
    .sitename {
  font-family: Arial, sans-serif; /* juste changer la police */
  font-weight: 700;
  color: var(--secondary-color);
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

    
    .navmenu ul li a {
      position: relative;
      color: var(--dark-color);
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .navmenu ul li a:hover,
    .navmenu ul li a.active {
      color: var(--primary-color);
    }
    
    .navmenu ul li a:after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--gradient);
      transition: width 0.3s ease;
    }
    
    .navmenu ul li a:hover:after,
    .navmenu ul li a.active:after {
      width: 100%;
    }
    
    .btn-getstarted {
      background: var(--gradient);
      border: none;
      color: white;
      font-weight: 600;
      padding: 10px 25px;
      border-radius: 50px;
      box-shadow: 0 5px 15px rgba(74, 166, 255, 0.4);
      transition: all 0.3s ease;
    }
    
    .btn-getstarted:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(74, 166, 255, 0.6);
    }
    
    /* Hero Section */
    .page-title {
      position: relative;
      padding: 180px 0 120px;
      background: linear-gradient(rgba(10, 29, 55, 0.85), rgba(10, 29, 55, 0.85)), url('assets/img/55.png') center/cover no-repeat;
      color: white;
      text-align: center;
    }
    
    .page-title h1 {
      font-family: Arial, sans-serif;
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      animation: fadeInDown 1s ease;
      text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    
    .page-title p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto 30px;
      animation: fadeInUp 1s ease;
      opacity: 0.9;
    }
    /* Dropdown styling */
    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      min-width: 220px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      padding: 10px 0;
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1000;
      border: none;
    }
  
    .nav-item.dropdown:hover .dropdown-menu {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }
  
    .dropdown-item {
      padding: 12px 25px;
      color: var(--secondary-color) !important;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: all 0.3s ease;
    }
  
    .dropdown-item:hover {
      background: rgba(13, 63, 114, 0.05);
      padding-left: 30px;
    }
  
    .dropdown-item i {
      color: var(--primary-color);
      font-size: 1.1em;
      width: 24px;
      text-align: center;
    }
        #map {
            height: 600px;
            width: 100%;
            margin: 20px 0;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .search-container {
            margin: 20px auto;
            max-width: 600px;
            position: relative;
        }

        #searchInput {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 50px;
            font-size: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        #searchInput:focus {
            border-color: #0d3f72;
            box-shadow: 0 2px 15px rgba(13, 63, 114, 0.2);
            outline: none;
        }

        .location-info {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .location-details {
            margin-top: 15px;
        }

        .info-item {
            margin-bottom: 10px;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .info-item i {
            margin-right: 10px;
            color: #0d3f72;
        }
    </style>
</head>

<body class="page-map">
    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="about.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">EasyParki</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html">Accueil</a></li>
          <li><a href="Stationnement.html">Stationnement</a></li>
          <li><a href="transport public.html">Vacances</a></li>
          <li><a href="Covoiturage.html">Covoiturage</a></li>
          <li><a href="Recharge.html">Service</a></li>
          <li class="dropdown">
             <a href="evenement.php"><span>Événements</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <li><a href="evenement.php">Page Événement</a></li>                
                <li><a href="billets.php">Vos Billets</a></li>
                <li><a href="durée.php">Let's Talk!</a></li>
                <li><a href="map.php">Map</a></li>
                <li><a href="points_fidelite.php">Fidelite</a></li>
              </ul>
           </li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="get-a-quote.html">Créer un compte</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
  <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/image/evenement.jpg);">
    <div class="container position-relative">
      <h1>Recherchez votre destination</h1>
      <p>Trouvez facilement n'importe quel lieu et obtenez des informations détaillées</p>
      <div class="mt-4">
        <a href="index.php" class="btn btn-light btn-lg px-4 me-2">Home</a>
        <a href="evenement.php" class="btn btn-outline-light btn-lg px-4">Evenements</a>
      </div>
    </div>
  </div><!-- End Hero Section -->

        <div class="container">
            <!-- Search Box -->
            <div class="search-container">
                <input 
                    id="searchInput" 
                    type="text" 
                    class="form-control" 
                    placeholder="Recherchez un lieu..."
                >
            </div>

            <!-- Map Container -->
            <div id="map"></div>

            <!-- Location Information -->
            <div class="location-info" id="locationInfo" style="display: none;">
                <h3>Informations sur le lieu</h3>
                <div class="location-details" id="locationDetails">
                    <!-- Les détails du lieu seront insérés ici dynamiquement -->
                </div>
            </div>
        </div>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1">EasyParki</strong> <span>All Rights Reserved</span></p>
        </div>
    </footer>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- Google Maps JavaScript -->
    <script>
        // Fonction pour gérer les erreurs de chargement de Google Maps
        function gm_authFailure() {
            document.getElementById('map').innerHTML = '<div class="alert alert-danger">' +
                '<strong>Erreur de chargement de Google Maps</strong><br>' +
                'Cela peut être dû à :<br>' +
                '- Une clé API invalide<br>' +
                '- Des restrictions de domaine<br>' +
                '- Services Google Maps non activés<br>' +
                'Veuillez vérifier la configuration de votre clé API Google Maps.</div>';
        }

        window.gm_authFailure = gm_authFailure;
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZsiO8rg9s1EKyRpiRrXeEq7R8p7HvVxM&libraries=places&callback=initMap" async defer></script>
    <script>
        // Fonction pour gérer les erreurs de chargement de Google Maps
        function handleMapError() {
            console.error('Erreur de chargement de Google Maps');
            document.getElementById('map').innerHTML = '<div class="alert alert-danger">Erreur de chargement de la carte. Veuillez réessayer.</div>';
        }

        let map;
        let marker;
        let autocomplete;

        // Initialisation de la carte
        function initMap() {
            try {
                // Position par défaut (centre de la Tunisie)
                const defaultLocation = { lat: 36.8065, lng: 10.1815 };
                
                if (!google || !google.maps) {
                    handleMapError();
                    return;
                }

                // Création de la carte
                map = new google.maps.Map(document.getElementById('map'), {
                    center: defaultLocation,
                    zoom: 12,
                    styles: [
                        {
                            "featureType": "poi",
                            "elementType": "labels",
                            "stylers": [
                                { "visibility": "off" }
                            ]
                        }
                    ]
                });

                // Création du marqueur initial (invisible au départ)
                marker = new google.maps.Marker({
                    map: map,
                    visible: false
                });

                // Initialisation de l'autocomplétion avec des options spécifiques pour la Tunisie
                const input = document.getElementById('searchInput');
                const options = {
                    bounds: new google.maps.LatLngBounds(
                        new google.maps.LatLng(30.2404, 7.5243),  // Sud-Ouest de la Tunisie
                        new google.maps.LatLng(37.7612, 11.5983)  // Nord-Est de la Tunisie
                    ),
                    componentRestrictions: { country: 'TN' },
                    fields: ['address_components', 'geometry', 'name', 'formatted_address', 'place_id', 'rating', 'user_ratings_total', 'formatted_phone_number', 'website'],
                    types: ['geocode', 'establishment']
                };
                
                autocomplete = new google.maps.places.Autocomplete(input, options);
                
                // Gestionnaire d'événements pour l'autocomplétion
                autocomplete.addListener('place_changed', function() {
                    const place = autocomplete.getPlace();
                    
                    if (!place.geometry || !place.geometry.location) {
                        // Utiliser le service Places pour rechercher manuellement si l'autocomplete échoue
                        const placesService = new google.maps.places.PlacesService(map);
                        const request = {
                            query: input.value,
                            fields: ['name', 'geometry', 'formatted_address', 'place_id'],
                            locationBias: options.bounds
                        };
                        
                        placesService.findPlaceFromQuery(request, function(results, status) {
                            if (status === google.maps.places.PlacesServiceStatus.OK && results && results.length > 0) {
                                const place = results[0];
                                updateMapAndInfo(place);
                            } else {
                                window.alert("Impossible de trouver ce lieu. Veuillez essayer une recherche plus précise.");
                            }
                        });
                        return;
                    }

                    updateMapAndInfo(place);
                });

                // Ajouter un gestionnaire d'événements pour la touche Entrée
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const query = input.value;
                        if (query) {
                            const placesService = new google.maps.places.PlacesService(map);
                            const request = {
                                query: query,
                                fields: ['name', 'geometry', 'formatted_address', 'place_id'],
                                locationBias: options.bounds
                            };
                            
                            placesService.findPlaceFromQuery(request, function(results, status) {
                                if (status === google.maps.places.PlacesServiceStatus.OK && results && results.length > 0) {
                                    const place = results[0];
                                    updateMapAndInfo(place);
                                } else {
                                    window.alert("Impossible de trouver ce lieu. Veuillez essayer une recherche plus précise.");
                                }
                            });
                        }
                    }
                });

            } catch (error) {
                console.error('Erreur lors de l\'initialisation de la carte:', error);
                handleMapError();
            }
        }

        // Fonction pour mettre à jour la carte et les informations
        function updateMapAndInfo(place) {
            // Ajuster la carte
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            // Mettre à jour le marqueur
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            // Obtenir plus de détails sur le lieu si nécessaire
            if (!place.formatted_phone_number || !place.website) {
                const placesService = new google.maps.places.PlacesService(map);
                placesService.getDetails({
                    placeId: place.place_id,
                    fields: ['formatted_phone_number', 'website', 'rating', 'user_ratings_total', 'formatted_address', 'name']
                }, function(detailedPlace, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        displayLocationInfo(detailedPlace);
                    }
                });
            } else {
                displayLocationInfo(place);
            }
        }

        // Fonction pour afficher les informations du lieu
        function displayLocationInfo(place) {
            const locationInfo = document.getElementById('locationInfo');
            const locationDetails = document.getElementById('locationDetails');
            let detailsHTML = '';

            // Nom du lieu
            if (place.name) {
                detailsHTML += `
                    <div class="info-item">
                        <i class="bi bi-building"></i>
                        <strong>Nom:</strong> ${place.name}
                    </div>`;
            }

            // Adresse
            if (place.formatted_address) {
                detailsHTML += `
                    <div class="info-item">
                        <i class="bi bi-geo-alt"></i>
                        <strong>Adresse:</strong> ${place.formatted_address}
                    </div>`;
            }

            // Numéro de téléphone
            if (place.formatted_phone_number) {
                detailsHTML += `
                    <div class="info-item">
                        <i class="bi bi-telephone"></i>
                        <strong>Téléphone:</strong> ${place.formatted_phone_number}
                    </div>`;
            }

            // Site web
            if (place.website) {
                detailsHTML += `
                    <div class="info-item">
                        <i class="bi bi-globe"></i>
                        <strong>Site web:</strong> <a href="${place.website}" target="_blank">${place.website}</a>
                    </div>`;
            }

            // Note
            if (place.rating) {
                detailsHTML += `
                    <div class="info-item">
                        <i class="bi bi-star-fill"></i>
                        <strong>Note:</strong> ${place.rating}/5 (${place.user_ratings_total} avis)
                    </div>`;
            }

            locationDetails.innerHTML = detailsHTML;
            locationInfo.style.display = 'block';
        }
    </script>
</body>
</html>