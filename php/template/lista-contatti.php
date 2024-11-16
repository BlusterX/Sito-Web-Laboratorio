<table>
    <tr>
        <th id="autore">Autore</th><th id="email">Email</th><th id="argomenti">Argomenti</th>
    </tr>
    <?php foreach ($templateParams["contatti"] as $contatto): ?>
    <tr>
        <th id="<?php echo getIdFromName($contatto["nome"]); ?>"><?php echo $contatto["nome"]?></th><td headers="email <?php echo getIdFromName($contatto["nome"]); ?>"><?php echo $contatto["username"]?></td><td headers="argomenti <?php echo getIdFromName($contatto["nome"]); ?>"><?php echo $contatto["argomenti"]?></td>
    </tr>
    <?php endforeach; ?>
</table>