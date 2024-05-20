<?php
require_once'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--Bootstrap-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js" ></script>

    <title>absen_crud</title>
</head>
<body>
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            CRUD - BS5
        </a>
    </nav>
    <!--Judul-->
    <div class="container">
        <h1 class="mt-4">Data Absensi</h1>
        <figure>
            <blockquote class="blockquote">
                <p>Berisi data yang telah disimpan di database</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                CRUD <cite title="source Title">Create Read Update Delete</cite>
            </figcaption>
        </figure>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>TIME</th>
                        <th>CARD_ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Mencetak hasil yang disimpan dalam variabel output
                        echo $output;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
