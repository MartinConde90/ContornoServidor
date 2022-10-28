<form action="form.php" method="post">
    <input name="nombre" type="text" placeholder="Nombre">
    <input name="apellidos" type="text" placeholder="Apellidos">
    <input name="nif" type="text" placeholder="NIF">
    <label for="sexo">Sexo</label>
    <select name="sexo" id="sexo">
        <option value="mujer">mujer</option>
        <option value="hombre">hombre</option>
        <option value="otro">otro</option>
    </select>
    <input name="enviar" type="submit">
</form>