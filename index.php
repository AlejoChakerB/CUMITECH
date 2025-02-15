<!DOCTYPE html>
<html>
<head>
  <title>CumiSystem - Página de Inicio</title>
  <!-- Enlaces CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
  <style>
    body {
        background-image: url("public/images/Fondo.jpg");
        background-size: cover;
    }
    .card {
      margin: auto;
      margin-top: 100px;
      max-width: 400px;
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background-color: #007bff;
      color: #ffffff;
      text-align: center;
    }
    .card-body {
      padding: 20px;
    }
    .btn-access {
      background-color: #28a745;
      color: #ffffff;
      border: none;
    }
    .btn-access:hover {
      background-color: #218838;
      color: #ffffff;
    }
    .text-fancy {
      font-family: 'Pacifico', cursive;
      font-size: 24px;
      text-align: center;
      margin-bottom: 20px;
      color: white;
      text-shadow: 2px 2px 4px rgba(255, 105, 180, 0.5);
    }
  </style>
  <!-- Fuente personalizada -->
  <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title text-fancy">CumiSystem</h3>
      </div>
      <div class="card-body">
        <p class="text-center"><strong>Bienvenido a CumiSystem, una página para la gestión de datos.</strong></p>
        <p class="text-center"><strong>Para iniciar sesión haga click en el botòn de abajo</strong></p>
        <div class="text-center">
          <a class="btn btn-access" href="http://10.1.11.239:8383/CUMI/public">Acceder a CumiSystem</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Enlaces JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>
</html>
