<?php
//Include las clases
require_once 'class/foros.php';
require_once 'class/subforos.php';
require_once 'class/temas.php';
require_once 'class/comentarios.php';
require_once 'class/usuarios.php';


include 'header.php';

?>
<div class="caja">
    <div class="categorias">
        <div class="temas_titulo">Usuarios</div>
        <div class="temas_respuestas">Temas</div>
        <div class="temas_ultimo">Temas / Comentarios</div>
        <div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
    </div>
    <div class="foro">
        <?php
        // listo todos los usuarios cosa de niños
        $obju = new Usuarios();
        $usuarios = $obju->usuarios();
        foreach ($usuarios as $u) {
            ?>
            <div class="foro_icono">
                <img src="img/note.png">
            </div>
            <div class="foro_titulo">
                <a href="perfil.php?id=<?php echo $u["id"]; ?>"><?php echo $u["nombre"]; ?> (<?php echo $u["nick"]; ?>)</a>
				<?php
				if ($_SESSION["nombre"] == "admin" or $temas["id_usuario"] == $_SESSION["id"]) {
				?>
                                    <a class="btn btn-link" href="eliminar.php?opc=6&id=<?php echo $u["id"]; ?>&dir=0">
                                        Eliminar</a>
                                        <?php
				}
				?>
            </div>
            <div class="temas_mensajes">
                <a href="temasusuario.php?id=<?php echo $u["id"]; ?>">Ver temas creados por <?php echo $u["nick"]; ?></a>
            </div>
            <div class="ultimocomentario">
                <?php
                $objTemas = new Temas();
                $temas = $objTemas->TotalTemasUsuarios($u["id"]);
                if (sizeof($temas) > 0) {
                    echo "Temas: " . $temas . "<br/>";
                } else {
                    echo 'Temas: 0';
                }

                $objC = new Comentarios();
                $comentarios = $objC->TotalComentariosUsuario($u["id"]);
                if (sizeof($temas) > 0) {
                    echo "Comentarios: " . $comentarios . "<br/>";
                } else {
                    echo 'Comentarios: 0';
                }
                ?>
            </div>
            <div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
            <?php
        }
        ?>
    </div>
</div>

<?php


include 'footer.php';
?>
