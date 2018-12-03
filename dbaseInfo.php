<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//require_once "DBase.php";
require_once "Usuario.class.php";
require_once "Comentario.class.php";
require_once "Entrada.class.php";
require_once "Dbase.class.php";

/*     

*/

//Usuarios
$user1 = "Carlos";
$nombre1 = "Carlos Zahumernszky";
$pass1 = "123";
$rol1 = "blogger";

$usuario1 = new Usuario($user1, $nombre1, $pass1, $rol1);

$user2 = "Jody";
$nombre2 = "Jody Serrano";
$pass2 = "123";
$rol2 = "blogger";

$usuario2 = new Usuario($user2, $nombre2, $pass2, $rol2);

$usuario3 = new Usuario("Miguel", "Miguel Jorge", "123", "blogger");
$usuario4 = new Usuario("lobezno", $nombre2, $pass2, $rol2);
$usuario5 = new Usuario("xavier", $nombre2, $pass2, $rol2);
$usuario6 = new Usuario("phoenix", $nombre2, $pass2, $rol2);

//Comentarios



    


//Entradas

//------------------------------------------------------------------------------------

$idEntrada1 = "E1";
$idComentario1 = $idEntrada1."C1";
$fechaHora1 = "201810251058";
$autor1 = "iCuma";
$texto1 = "No he visto el documental completo, pero creo que la diferencia radica en que en el documental utilizan una herramienta para resolver un problema que les otorga otra herramienta para resolver un problema... Y así. En cambio en este nuevo estudio utilizan varios objetos para construir una herramienta con la que resolver un problema.";

$comentario1 = new Comentario($idComentario1, $idEntrada1, $fechaHora1, $autor1, $texto1);

$idEntrada2 = "E1";
$idComentario2 = $idEntrada2."C2";
$fechaHora2 =  "201801021052";
$autor2 = "Juiosy";
$texto2 = "Perooooo eso hace años que ya lo pasaron en un documental... ";

$comentario2 = new Comentario($idComentario2,$idEntrada2, $fechaHora2,$autor2,$texto2);

$comentarioArr1 = array($comentario1, $comentario2);

$entrada1 = new Entrada(
	"E1",
	"201704250733","Descubren que los cuervos son capaces de fabricar y usar herramientas complejas de varias piezas",
	$usuario1->user,"Sabemos que los cuervos son unos animales inteligentes capaces de reconocer a una persona, de guardar rencor, de llorar a sus muertos y hasta de tener sexo con ellos. Un nuevo estudio acaba de mostrar, además, que sus habilidades a la hora de usar herramientas no se limita a usarlas. También las fabrican. Se sabía ya que el cerebro de los cuervos es lo bastante avanzado como para relacionar causa y efecto, predecir las consecuencias de una acción e incluso para utilizar pequeños palitos o herramientas sencillas, pero la capacidad de fabricar esas herramientas es algo completamente inédito y hasta un poco inquietante. Ni siquiera los seres humanos tienen esa habilidad hasta pasados unos años de vida.

    El descubrimiento llega a partir de una serie de experimentos realizados por el ornitólogo Auguste von Bayern en el Instituto de Ornitología Max Planck y la Universidad de Oxford. Von Bayern y su equipo pusieron a una serie de cuervos de Nueva Caledonia (Corvus moneduloides) ante un sencillo rompecabezas. 

    En una caja transparente pusieron una apetitosa larva y junto a ella un palito largo. El objetivo del juego era utilizar el palito para empujar el insecto hasta una bandeja al otro lado. Los cuervos no tardaron en resolver el problema. Entonces les presentaron una segunda caja similar, pero con una variante: no había palito largo. En su lugar solo había varios fragmentos cortos.Los fragmentos (pequeños tubos en realidad) tenían orificios por un lado de manera que podían unirse para construir un palito más largo.",
	$comentarioArr1);
//**------------------------------------------------------------------

$idEntrada3 = "E2";
$idComentario3 = $idEntrada3."C3";
$fechaHora3 =  "201810031102";
$autor3 = "RufusNK";
$texto3 = "Parte uno, ya puedes arrancarlo, pararlo y abrir puertas desde el teléfono... pero controlarlo como un RC lo veo peligroso. Ahora, para sacarlo de una plaza estrecha de los típicos aparcamientos de supermercado o meterlo para no tener que pasar el mal rato y golpear otro coche con la puerta me parece genial... en ese caso y a una velocidad controlada, seria practico y poco peligroso.";

$comentario3 = new Comentario($idComentario3,$idEntrada3, $fechaHora3,$autor3,$texto3);

$idEntrada4 = "E2";
$idComentario4 = $idEntrada4."C4";
$fechaHora4 =  "201812090052";
$autor4 = "Elliot";
$texto4 = "Parte dos, ya puedes arrancarlo, pararlo y abrir puertas desde el teléfono... pero controlarlo como un RC lo veo peligroso. Ahora, para sacarlo de una plaza estrecha de los típicos aparcamientos de supermercado o meterlo para no tener que pasar el mal rato y golpear otro coche con la puerta me parece genial... en ese caso y a una velocidad controlada, seria practico y poco peligroso.";

$comentario4 = new Comentario($idComentario4,$idEntrada4, $fechaHora4,$autor4,$texto4);


$comentarioArr2 = array($comentario3,$comentario4);    


$entrada2 = new Entrada(
	"E2",
	"201708021144","Cómo corregir errores en los mapas de Apple y Google (y por qué deberías hacerlo)",
	$usuario2->user, "Siempre me acordaré cuando la aplicación de Mapas de Apple me llevó a un Wal-Mart que no existía. En su lugar había campo por un lado y varios edificios con luces apagadas por el otro. Confirmé en la aplicación otra vez. No, estaba en el lugar correcto según el punto azul. Pero no había nada ahí. 

    Pocos minutos después el problema era obvio, por supuesto: había un error en la información que tenía la aplicación. No es un problema poco común en aplicaciones como Mapas y Google Maps, que son geniales cuando son precisas pero desesperantes cuando tienen errores. Sin embargo, hay formas sencillas para corregir los errores en estas aplicaciones que pueden convertir al mundo en un lugar mejor. 

    Apple Mapas:  

    Apple te permite tomar varias acciones para corregir sus mapas desde tu iPhone o tu Mac. Puedes añadir información, corregir información incorrecta o subir detalles sobre tu propio negocio. Cuando se trata de negocios, puedes corregir información aunque no tengas una conexión directa al sitio.

    Para corregir información desde iOS: Si estás utilizando la aplicación Mapas en tu iPhone, haz clic en el botón con la â€œiâ€? en la esquina superior derecha. Esto abrirá otro menú que donde tendrás que escoger si quieres Añadir un lugar o Informar de un problema.

    La opción de Añadir un lugar te permite crear una referencia para un nuevo negocio o una nueva calle, entre otros. En estos casos, tienes que colocar el marcador en el nuevo sitio o en la calle. Si estás añadiendo un nuevo sitio al mapa, Apple te hará preguntas sobre el lugar, como las horas de negocio y el sector en el que opera. Apple también te permitirá subir fotos.

    Si decides que quieres Informar de un problema, podrás editar información sobre lugares existentes. Esto puede incluir detalles como un número de teléfono o las horas de operación. También puedes indicar si un sitio ha cerrado. Cuando corriges algo, esto se convierte en una sugerencia que luego debe ser aprobado por el equipo de Apple.

    Para corregir información desde tu Mac: Mapas en macOS funciona de la misma forma que en iOS. Por lo tanto, todos los métodos mencionados anteriormente aplican cuando quieres corregir información desde tu ordenador.

    Google Maps

    Google también te permite corregir información en sus mapas mediante tu  ordenador y directamente en la aplicación. Puedes modificar información  incorrecta relacionada con las horas de operación o la dirección de un negocio, entre otros detalles.",
	$comentarioArr2);


////--------------------------------------------------------------------------------------

$comentario5 = new Comentario("C5","E3", "201809110730","SideshowBob","A tenor de los videos que circulan por youtube y similares... esta debe ser la zona más visitada de Ucrania con diferencia.");
$comentario6 = new Comentario("C6","E3", "201809110753","Javier","Es más, ese UAZ 452, aparece en todas, debe ser de la empresa que hace las excursiones. Eso sí, son en invierno, donde todo está seco y amarillo, porque en primavera o verano, es un bosque hermoso donde la naturaleza está reclamando lo que era suyo. ");

$comentarioArr3 = array($comentario5,$comentario6);   


$entrada3 = new Entrada(
	"E3",
	"201801090646",
	"Se adentra en un área de exclusión de Chernobyl y graba la zona que sufrió el 70% del desastre nuclear",
	$usuario3->user, "Tras el desastre nuclear de Chernobyl en 1986, más de una cuarta parte del país se contaminó con polvo radiactivo y cenizas que afectaron a siete millones de personas. Las imágenes que obtuvieron un grupo de exploradores urbanos muestran el daño en la zona que sufrió un 70% de las consecuencias.

	Una quinta parte de la agricultura del país se vio afectada, con hasta un millón de hectáreas, aproximadamente el tamaño de un millón de campos de rugby, que no se pueden utilizar durante los próximos 100 años.

	La secuencia, capturada por Bob Thissen, se grabó en la Reserva Radioecológica Estatal de Polesia hace dos meses para observar el daño duradero en la zona de exclusión tras 32 años de abandono. Aldeas que anteriormente eran el hogar de más de 1.000 personas hoy permanecen casi intactas, tan solo afectadas por los elementos.

    Como se puede apreciar, las estrellas soviéticas, los carteles de propaganda y los libros escolares se encuentran casi intactos, aparte de una fina capa de tierra y polvo, junto con una pila de máscaras de gas abandonadas en alguna habitación.

    Por cierto, Thissen cuenta que para poder adentrarte en este tipo de zonas se necesita ayuda de otros exploradores urbanos que conocen rutas y accesos, muchos de ellos hoy convertidos en investigadores que estudian los efectos de la radiación en los animales de la zona, además de la necesaria aprobación de hasta tres organizaciones gubernamentales diferentes y la ayuda de los empleados de la reserva",
	$comentarioArr3);

//--------------------------------------------------------------------------------

$comentario7 = new Comentario("C7","E5","201811221131","JAS-1138","Comentario 7 para la entrada 4 ");
$comentario8 = new Comentario("C8","E5","201811221201","flunxone","Comentario 8 para la entrada 4 ");

$comentarioArr4 = array($comentario7,$comentario8);

$entrada4 = new Entrada(
	"E4",
	"201810221045",
	"En 1935, los nazis organizaron un concurso para encontrar al ario perfecto. Goebbels eligió a esta niña. Era judía",
	$usuario1->user,"La imagen que vemos en portada nos muestra a Hessy Levinsons Taft, una niña de ojos grandes que adornó la portada de varias revistas nazis, todas bajo el mismo eslogan: habían encontrado “el ario perfecto” a través de un concurso donde Joseph Goebbels la había nombrado ganadora.
	
	Desde ese instante, la imagen se extendió a las postales y vallas publicitarias abriéndose camino a través de la Alemania nazi. Estaba destinada a ser un ejemplo para los padres de todo el mundo bajo el ideal de la “raza superior”. Sin embargo, pocos sabían entonces que el mismo Goebbels había seleccionado para la persona aria más bella del planeta a una chica judía.
	
	El fotógrafo de la instantánea, Hans Ballin, originalmente tomó la imagen a finales de 1934. Lo hizo como una foto de bebé estándar para que los padres de Taft la conservaran. Unos meses después y sin consultarlo con ellos, Ballin envió secretamente su foto al concurso que los nazis habían anunciado. Y resultó ganadora.
	
	La increíble historia de Hessy Levinsons Taft no termina ahí. Varias décadas después, en 1990, la mujer detalló la aventura de su vida en el Museo del Holocausto de Estados Unidos.
	
	Una historia que comienza cuando los padres de Taft, Jacob y Pauline Levinsons, llegaron a Berlín en 1928, apenas unos años antes de que Hitler tomara el poder. La joven pareja, ambos judíos letones, soñaba con convertirse en cantantes famosos. Sin embargo, con el antisemitismo en aumento, Jacob y Pauline no pudieron conseguir trabajo. Arruinados y viviendo en un pequeño apartamento, Pauline dio a luz a su hija el 17 de mayo de 1934. Tal y como relató Taft:
	
	Mi madre me llevó a un fotógrafo, uno de los mejores de Berlín. El hombre hizo una imagen muy hermosa, o una que a mis padres les pareció muy hermosa.
	
	De hecho, los orgullosos padres pusieron la foto en la entrada de su casa. Unos meses después, una amiga de la familia les dijo que había reconocido la instantánea porque apareció en una revista de los alemanes. Con incredulidad, Pauline le pidió a la mujer que le comprara una copia de la revista. Y, efectivamente, el rostro de Taft estaba en la portada. Horrorizados de ver a su pequeña en la portada de una importante revista nazi, llamaron al fotógrafo. Ballin le explicó lo siguiente a Pauline: 
	
	Te explico lo que ocurrió. Me pidieron que enviara mis 10 mejores fotos para un concurso de belleza organizado por los alemanes. También había otros 10 fotógrafos destacados de Alemania. Así que 10 fotógrafos presentaron sus 10 mejores fotos. Y entre ellas envié la foto de tu hija. Querían encontrar el ejemplo perfecto de la raza aria para promover la filosofía nazi.
	
	Sí, sé que tu hija es judía, pero también quería tener el placer de llevar a cabo esta broma. Y ya ves, tenía razón. De todos los bebés, escogieron a uno judío como el ario perfecto. Lo siento, pero quería ridiculizar a los nazis.

	Si Taft y su familia se salvaron fue porque la historia se mantuvo en secreto desde entonces. Una pequeña batalla ganada contra los nazis con la que los Levinsons se reían de vez en cuando, incluso para el primer cumpleaños de Taft, su tía le compró una tarjeta nazi con su propia cara.

	Taft se estableció en Estados Unidos a finales de los años cuarenta. Luego se casó y se convirtió en profesora de química en la Universidad St. John en Nueva York. En julio de 2014, Taft habló de todo ello al periódico alemán Bild: “ahora puedo reírme de aquello, pero si los nazis hubieran sabido quién era realmente, hoy no estaría viva”. [Wikipedia, Washington Post]",
	$comentarioArr4);


//---------------------------------------------------------------------------------------------------------------

$comentario9 = new Comentario("C9","E5","201811221131","JAS-1138","pensé que hacían comida para gato con eso... ");
$comentario10 = new Comentario("C10","E5","201811221201","flunxone","empieza usted a caerme realmente mal");

$comentarioArr5 = array($comentario9,$comentario10);


$entrada5 = new Entrada(
	"E5","201810221122","Esta compañía de cruceros Noruega planea usar restos de pescado como combustible",
	$usuario1->user,"Si por alguna extraña razón tienes la casa llena de peces muertos, a alguien se le ha ocurrido lo que puedes hacer con ellos: ¡utilizarlos como combustible! Sí, finalmente, los cruceros pueden aprovechar el potencial casi ilimitado de los cadáveres de los peces gracias a la inversión en I+D de una compañía noruega.
	
	La línea de cruceros se llama Hurtigruten, tiene una flota de 17 barcos y está especializada en cruceros árticos. Hurtigruten planea transformar para 2021 al menos seis de sus embarcaciones de forma que puedan funcionar con biogás, un combustible que producirán, en gran parte, a partir de trozos de pescado muerto sobrante de la pesca y de las industrias de procesado. El biogás se usará en lugar de los otros combustibles fósiles que habitualmente usan estos cruceros. Esto es lo que dice el CEO de Hurtigruten, Daniel Skjeldam, acerca de su combustible:
	
	Noruega es una gran nación marítima. La pesca y la piscicultura son grandes sectores. Crean empleos y generan ingresos, pero también producen muchos desechos. El acceso constante a altos volúmenes de residuos orgánicos deja a los países nórdicos en una posición única en el mercado de biogás. Estamos buscando más innovación, más inversión. Creo que esto es el comienzo de lo que en unos pocos años será un sector enorme”.
	
	El biogás producido a partir de desechos orgánicos es principalmente metano. Viendo los propios deshechos biológicos que producen los pasajeros enfermos a borde de los cruceros, el siguiente paso inteligente sería aprovechar sus secreciones intestinales y convertirlas en combustible. Ya veremos dentro de unos años hasta donde llegan las líneas de crucero noruegas.",$comentarioArr5);


$entradaArr = new BD();

$entradaArr->addEntrada($entrada1);
$entradaArr->addEntrada($entrada2);
$entradaArr->addEntrada($entrada3);
$entradaArr->addEntrada($entrada4);
$entradaArr->addEntrada($entrada5);

$usuarioArr = new BD();

$usuarioArr->addUsuario($usuario1);
$usuarioArr->addUsuario($usuario2);
$usuarioArr->addUsuario($usuario3);
$usuarioArr->addUsuario($usuario4);
$usuarioArr->addUsuario($usuario5);
$usuarioArr->addUsuario($usuario6);

$_SESSION['entradaArr'] = $entradaArr;
$_SESSION['usuarioArr'] = $usuarioArr;

?>