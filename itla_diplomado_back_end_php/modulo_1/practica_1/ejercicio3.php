<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Práctica #1 - Ejercicios Básicos con PHP</title>
</head>
<body>
    <div class="main-container">
        <h1>Práctica #1 - Ejercicios Básicos con PHP</h1>
        <h3><span class="label">Matrícula:</span> 40220759860</h3>
        <h3><span class="label">Participante:</span> Kevin Feliz Henríquez</h3>
        <h3><span class="label">Profesor:</span> Adrian Fondeur</h3>
        <h3><span class="label">Nombre del Diplomado:</span> Back-End con PHP</h3>
        <h3><span class="label">Nombre de la Academia:</span> Instituto Tecnológico de las Americas</h3>
        <h3><span class="label">Nombre de la Actividad:</span> Práctica #1 - Ejercicios Básicos con PHP</h3>

        <div class="practice-content">
            <?php
                function esPrimo(int $num): bool {
                    if ($num <= 1) return false;
                    if ($num == 2) return true;
                    if ($num % 2 == 0) return false;
                
                    for ($i = 3; $i <= sqrt(num: $num); $i += 2) {
                        if ($num % $i == 0) return false;
                    }
                    return true;
                }
                
                echo "Primeros 30 números primos:<br>";
                $contador = 0;
                $num = 2;
                while ($contador < 30) {
                    if (esPrimo($num)) {
                        echo $num . " ";
                        $contador++;
                    }
                    $num++;
                }
            ?>
        </div>
    </div>
</body>
</html>
