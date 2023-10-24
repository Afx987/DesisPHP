<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Votación</title>
    <link rel="stylesheet" type="text/css" href="/../../public/css/estilo.css">
</head>
<body>
    <h1>Formulario de Votación</h1>
    <form action="app/controllers/VotacionController.php" method="POST">
        <label for="nombres_apellidos">Nombres y Apellidos:</label>
        <input type="text" name="nombres_apellidos" required><br>

        <label for="alias">Alias:</label>
        <input type="text" name="alias" required><br>

        <label for="rut">RUT:</label>
        <input type="text" name="rut" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="region">Región:</label>
        <input type="text" name="region" required><br>

        <label for="comuna">Comuna:</label>
        <input type="text" name="comuna" required><br>

        <label for="candidato">Candidato:</label>
        <select name="candidato">
            <option value="candidato1">Candidato 1</option>
            <option value="candidato2">Candidato 2</option>
            
        </select><br>

        <label>Cómo se enteró de nosotros:</label><br>
        <input type="checkbox" name="referencia[]" value="Web"> Web<br>
        <input type="checkbox" name="referencia[]" value="TV"> TV<br>
        <input type="checkbox" name="referencia[]" value="Redes Sociales"> Redes Sociales<br>
        <input type="checkbox" name="referencia[]" value="Amigo"> Amigo<br>

        <input type="submit" name="votar" value="Votar">
    </form>
</body>
</html>
