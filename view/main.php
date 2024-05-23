<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>ROTACION DE HERRAMIENTA</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/cover/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../assets/css/cover.css" rel="stylesheet">
    <!-- JQuery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  </head>
<body class="d-flex h-100 text-center text-bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
        <h3 class="float-md-start mb-0">Cover</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="#">Home</a>
            <a class="nav-link fw-bold py-1 px-0" href="#">Features</a>
            <a class="nav-link fw-bold py-1 px-0" href="#">Contact</a>
        </nav>
        </div>
    </header>

    <main class="px-3">
        <div id="in_out_check">
            <h1>REGISTRO DE ENTRADA O SALIDA</h1>
            <div class="mb-3">
                    <input type="email"  autocomplete="off" class="form-control" id="txt_in_out" name="txt_in_out">
                </div>
        </div>

        <div id="tool_check">
            <h1>REGISTRO DE HERRAMIENTA</h1>
            <div class="mb-3">
                    <input type="text"  autocomplete="off" class="form-control" id="txt_tool" name="txt_tool">
                </div>
           
        </div>

        <div id="employee_check">
            <h1>REGISTRO DE EMPLEADO</h1>
            <div class="mb-3">
                <input type="email"  autocomplete="off" class="form-control" id="txt_employee" name="txt_employee">
            </div>
            <p class="lead">
                <a  id="btn_safe" class="btn btn-lg btn-light fw-bold border-white bg-white">recargar</a>
            </p>
        </div>
    </main>

    <footer class="mt-auto text-white-50">
       
    </footer>
    </div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../controller/main.js"></script>

    </body>
</html>
