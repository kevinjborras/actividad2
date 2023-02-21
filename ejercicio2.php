<!DOCTYPE html>
<html>
<head>
	<title>Estadisticas de Estudiantes</title>
</head>
<body>
	<h1>Estadisticas de Estudiantes</h1>

	<?php
	// Definir los arrays para almacenar los datos de los estudiantes
	$cedulas = array();
	$nombres = array();
	$notas_matematicas = array();
	$notas_fisica = array();
	$notas_programacion = array();

	// Leer la cantidad de estudiantes desde un formulario HTML
	if (isset($_POST["cantidad_estudiantes"])) {
		$cantidad_estudiantes = $_POST["cantidad_estudiantes"];

		// Leer los datos de cada estudiante desde el formulario
		for ($i = 0; $i < $cantidad_estudiantes; $i++) {
			$cedulas[$i] = $_POST["cedula$i"];
			$nombres[$i] = $_POST["nombre$i"];
			$notas_matematicas[$i] = $_POST["nota_matematicas$i"];
			$notas_fisica[$i] = $_POST["nota_fisica$i"];
			$notas_programacion[$i] = $_POST["nota_programacion$i"];
		}

		// Calcular las estadísticas solicitadas
		$promedio_matematicas = array_sum($notas_matematicas) / $cantidad_estudiantes;
		$promedio_fisica = array_sum($notas_fisica) / $cantidad_estudiantes;
		$promedio_programacion = array_sum($notas_programacion) / $cantidad_estudiantes;

		$num_aprobados_matematicas = 0;
		$num_aprobados_fisica = 0;
		$num_aprobados_programacion = 0;
		$num_aprobados_todas = 0;
		$num_aprobados_una = 0;
		$num_aprobados_dos = 0;

		$max_nota_matematicas = max($notas_matematicas);
		$max_nota_fisica = max($notas_fisica);
		$max_nota_programacion = max($notas_programacion);

		for ($i = 0; $i < $cantidad_estudiantes; $i++) {
			$notas = array($notas_matematicas[$i], $notas_fisica[$i], $notas_programacion[$i]);
			$num_aprobadas = 0;

			foreach ($notas as $nota) {
				if ($nota >= 10) {
					$num_aprobadas++;
				}
			}

			if ($num_aprobadas == 3) {
				$num_aprobados_todas++;
			} else if ($num_aprobadas == 1) {
				$num_aprobados_una++;
			} else if ($num_aprobadas == 2) {
				$num_aprobados_dos++;
			}

			if ($notas_matematicas[$i] < 10) {
				$num_aprobados_matematicas++;
			}
			if ($notas_fisica[$i] < 10) {
				$num_aprobados_fisica++;
			}
			if ($notas_programacion[$i] < 10) {
				$num_aprobados_programacion++;
			}
		}

				// Mostrar las estadísticas en una tabla HTML
                echo "<table>";
                echo "<tr><th>Materia</th><th>Promedio</th><th>Num. Aprobados</th><th>Nota Máxima</th></tr>";
                echo "<tr><td>Matemáticas</td><td>$promedio_matematicas</td><td>$num_aprobados_matematicas</td><td>$max_nota_matematicas</td></tr>";
                echo "<tr><td>Física</td><td>$promedio_fisica</td><td>$num_aprobados_fisica</td><td>$max_nota_fisica</td></tr>";
                echo "<tr><td>Programación</td><td>$promedio_programacion</td><td>$num_aprobados_programacion</td><td>$max_nota_programacion</td></tr>";
                echo "</table>";
        
                echo "<p>Num. de estudiantes que aprobaron todas las materias: $num_aprobados_todas</p>";
                echo "<p>Num. de estudiantes que aprobaron una sola materia: $num_aprobados_una</p>";
                echo "<p>Num. de estudiantes que aprobaron dos materias: $num_aprobados_dos</p>";
            }
            ?>
        
            <!-- Formulario para ingresar los datos de los estudiantes -->
            <form method="post">
                <label>Cantidad de estudiantes:</label>
                <input type="number" name="cantidad_estudiantes"><br><br>
        
                <?php
                if (isset($cantidad_estudiantes)) {
                    for ($i = 0; $i < $cantidad_estudiantes; $i++) {
                        echo "<label>Cédula de identidad del alumno #$i:</label>";
                        echo "<input type='text' name='cedula$i'><br>";
                        echo "<label>Nombre del alumno #$i:</label>";
                        echo "<input type='text' name='nombre$i'><br>";
                        echo "<label>Nota de matemáticas del alumno #$i:</label>";
                        echo "<input type='number' name='nota_matematicas$i'><br>";
                        echo "<label>Nota de física del alumno #$i:</label>";
                        echo "<input type='number' name='nota_fisica$i'><br>";
                        echo "<label>Nota de programación del alumno #$i:</label>";
                        echo "<input type='number' name='nota_programacion$i'><br><br>";
                    }
                    echo "<input type='submit' value='Calcular estadísticas'>";
                }
                ?>
            </form>
        </body>
        </html>
        