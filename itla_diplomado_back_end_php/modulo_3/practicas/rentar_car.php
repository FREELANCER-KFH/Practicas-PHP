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
        <h3><span class="label">Nombre de la Actividad:</span> Práctica - Rent a Car</h3>

        <div class="practice-content">
            <?php
                class Vehiculo {
                    public $marca;
                    public $modelo;
                    public $anio;
                    public $tipo;
                
                    public function __construct($marca, $modelo, $anio, $tipo) {
                        $this->marca = $marca;
                        $this->modelo = $modelo;
                        $this->anio = $anio;
                        $this->tipo = $tipo;
                    }
                
                    public function mostrarDetalles() {
                        echo "Vehículo: Marca: $this->marca, Modelo: $this->modelo, Año: $this->anio, Tipo: $this->tipo\n";
                    }
                }
                
                class Cliente {
                    public $nombre;
                    public $apellido;
                    public $numeroLicencia;
                    public $historialAlquileres = []; 
                
                    public function __construct($nombre, $apellido, $numeroLicencia) {
                        $this->nombre = $nombre;
                        $this->apellido = $apellido;
                        $this->numeroLicencia = $numeroLicencia;
                    }
                
                    public function agregarAlquiler($alquiler) {
                        $this->historialAlquileres[] = $alquiler;
                    }
                
                    public function mostrarDetalles() {
                        echo "Cliente: Nombre: $this->nombre $this->apellido, Número de licencia: $this->numeroLicencia\n";
                        echo "Historial de Alquileres:\n";
                        foreach ($this->historialAlquileres as $alquiler) {
                            $alquiler->mostrarDetalles();
                        }
                    }
                }
                
                class Alquiler {
                    public $fechaInicio;
                    public $fechaFin;
                    public $vehiculo;
                    public $costoTotal;
                
                    public function __construct($fechaInicio, $fechaFin, $vehiculo) {
                        $this->fechaInicio = $fechaInicio;
                        $this->fechaFin = $fechaFin;
                        $this->vehiculo = $vehiculo;
                        $this->costoTotal = 0; 
                    }
                
                    public function calcularCosto($tarifaDiaria) {
                        $dias = (strtotime($this->fechaFin) - strtotime($this->fechaInicio)) / 86400; 
                        $this->costoTotal = $dias * $tarifaDiaria;
                        return $this->costoTotal;
                    }
                
                    public function mostrarDetalles() {
                        echo "Alquiler: Fecha de Inicio: $this->fechaInicio, Fecha de Fin: $this->fechaFin, Costo Total: $this->costoTotal\n";
                        echo "Vehículo Alquilado:\n";
                        $this->vehiculo->mostrarDetalles();
                    }
                }
                
                $vehiculo = new Vehiculo("Toyota", "Corolla", 2021, "Sedán");
                $cliente = new Cliente("Juan", "Pérez", "12345678");
                $alquiler = new Alquiler("2024-12-01", "2024-12-05", $vehiculo);
                $alquiler->calcularCosto(50); 
                $cliente->agregarAlquiler($alquiler);
               
                $vehiculo->mostrarDetalles();
                $cliente->mostrarDetalles();
                
            ?>
        </div>
    </div>
</body>
</html>