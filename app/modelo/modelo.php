<?php

require_once './config.php';

class Modelo {
  protected $db;

  public function __construct() {
    $this->db = new PDO ("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
    $this->deploy();
  }

  private function deploy() {
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll();
    if(count($tables) == 0) {
      $sql =<<<END
        CREATE TABLE `generos` (
          `id_genero` int(11) NOT NULL,
          `genero` varchar(50) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        
        --
        -- Volcado de datos para la tabla `generos`
        --
        
        INSERT INTO `generos` (`id_genero`, `genero`) VALUES
        (1, 'Accion'),
        (2, 'Policial'),
        (3, 'Fantasia'),
        (4, 'Realismo Mágico'),
        (5, 'Epico'),
        (6, 'Ciencia Ficción');
        
        -- --------------------------------------------------------
        
        --
        -- Estructura de tabla para la tabla `libros`
        --
        
        CREATE TABLE `libros` (
          `id` int(11) NOT NULL,
          `titulo` varchar(50) NOT NULL,
          `autor` varchar(50) NOT NULL,
          `sinopsis` varchar(1000) NOT NULL,
          `anio` int(4) NOT NULL,
          `genero` int(4) NOT NULL,
          `precio` float NOT NULL,
          `disponibilidad` tinyint(1) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        
        --
        -- Volcado de datos para la tabla `libros`
        --
        
        INSERT INTO `libros` (`id`, `titulo`, `autor`, `sinopsis`, `anio`, `genero`, `precio`, `disponibilidad`) VALUES
        (1, 'El Camino de los Reyes', 'Brandom Sanderson', 'En Roshar, un mundo de piedra y tormentas, extrañas tempestades de increíble potencia barren el rocoso territorio de tal manera que han dado forma a una nueva civilización escondida. Han pasado siglos desde la caída de las diez órdenes consagradas conocidas como los Caballeros Radiantes, pero sus espadas y armaduras aún permanecen.', 2010, 3, 30960, 1),
        (2, 'Las Aventuras de Sherlock Holmes', 'Arthur Conan Doyle', 'En esta saga, seguiremos al Dr. Watson, amigo y compañero de Sherlock Holmes, detective privado británico, quien usa toda su agudeza intelectual y toda clase de habilidades para resolver los casos.', 1892, 2, 6000, 1),
        (3, 'Ataque a los Titanes Vol. 13', 'Hajime Isayama', 'Eren y sus compañeros soldados de la Legión de Exploración quienes todavía luchan por su supervivencia contra los terroríficos Titanes. Sin embargo, las amenazas surgen no solo de los titanes más allá de las murallas, sino también de los humanos dentro de las murallas. Después de ser rescatado del Titán Colosal y el Titán Blindado, todo parece estar bien para los soldados, hasta que el gobierno de repente exige la custodia de Eren e Historia.', 2014, 1, 2970, 0),
        (4, 'Cantar del Mio Cid', 'Desconocido', 'El Cantar de Mio Cid trata el tema del honor, un valor de gran importancia para la gente de la época. La necesidad de recuperar la honra perdida es lo que da impulso a las hazañas acometidas por el héroe. El poema se inicia con el destierro del Cid, primer motivo de deshonra, tras una acusación de robo.', 1200, 5, 7300, 1),
        (5, 'Harry Potter y la Orden del Fénix', 'J. K. Rowling', 'Cuando por fin comienza otro curso en el famoso colegio de magia y hechicería, Los temores de Harry Potter se vuelven realidad. El Ministerio de Magia niega que Voldemort haya regresado y ha iniciado una campaña de desprestigio contra Harry y Dumbledore.', 2003, 3, 15340, 0),
        (6, 'Cien Años de Solead', 'Gabriel García Márquez', 'Entre la boda de José Arcadio Buendía con Amelia Iguarán hasta la maldición de Aureliano Babilonia transcurre todo un siglo. Cien años de soledad para una estirpe única, fantástica, capaz de fundar una ciudad tan especial como Macondo y de engendrar niños con cola de cerdo. En medio, una larga docena de personajes dejarán su impronta a las generaciones venideras, que tendrán que lidiar con un mundo tan complejo como sencillo.', 1967, 4, 8999, 1),
        (7, 'Los Días del Venado', 'Liliana Bodoc', 'En las Tierras Fértiles se desplega una invasión por parte de los ejércitos que han llegado a través del mar desde las Tierras Antiguas. Los diversos pueblos luchan contra las huestes del mismísimo hijo de la muerte.', 2000, 3, 6119, 1),
        (8, 'Odisea', 'Homero', 'La historia narra el viaje de regreso del héroe Odiseo a su patria, la isla de Ítaca, tras su participación en la guerra de Troya. Su travesía estará llena de peligros y aventuras.', 1851, 5, 2782, 1),
        (9, 'Rayuela', 'Julio Cortázar', 'El amor turbulento de Oliveira y La Maga, los amigos del Club de la Serpiente, las caminatas por Paría en busca del cielo y el infierno tienen su reverso en la aventura simétrica de Oliveira, Talira y Traveler en un Buenos Aires teñido por el recuerdo.', 1963, 4, 5000, 0),
        (10, '1984', 'George Orwell', 'Londres, 1984: el Gran Hermano controla hasta el último detalle de la vida privada de los ciudadanos. Winston Smith trabaja en el Ministerio de la Verdad reescribiendo y retocando la historia para un estado totalitario que somete de forma despiadada a la población, hasta que siente que no quiere contribuir más a este sistema perverso y decide rebelarse.', 1984, 6, 4886, 1),
        (11, 'Cuentos Policiales', 'Edagr Allan Poe', 'Considerado como una de las grandes figuras del género policial y del terror, este autor domina con maestría el arte del suspenso, que plasma en sus presentes narraciones. A lo largo de cuatro breves relatos, Poe nos relata el enigma oculto que encierra un escarabajo dorado y su peculiar dibujo, los espantosos crímenes cometidos en la Rue Morgue, el asesinato de una joven parisiense llamada Marie Roget y el robo de una carta con importantes connotaciones políticas.', 2000, 2, 3500, 0),
        (12, 'Veinte mil leguas de viaje submarino', 'Julio Verne', 'Cuando de forma inesperada varios buques en distintos mares empiezan a sufrir el ataque de una monstruosa criatura marina que los manda a pique, periódicos y científicos de todo el mundo debaten alarmados acerca de la naturaleza del misterioso animal y de las causas de su comportamiento.', 1869, 6, 3080, 1),
        (13, 'El Corazón Delator', 'Edgar Allan Poe', 'Presenta a un narrador anónimo obsesionado con el ojo enfermo (que llama «ojo de buitre») de un anciano con el cual convive. Finalmente decide asesinarlo. El crimen es estudiado cuidadosamente y, tras ser perpetrado, el cadáver es despedazado y escondido bajo las tablas del suelo de la casa.', 1843, 6, 1799, 0),
        (14, 'Juramentada', 'Brandom Sanderson', 'La humanidad se enfrenta a una nueva Desolación con el regreso de los Portadores del Vacío, un enemigo tan grande en número como en sed de venganza. La victoria fugaz de los ejércitos alezi de Dalinar Kholin ha tenido consecuencias: el enemigo parshendi ha convocado la violenta tormenta eterna, que arrasa el mundo y hace que los hasta ahora pacíficos parshmenios descubran con horror que llevan un milenio esclavizados por los humanos.', 2018, 1, 21469, 1),
        (15, 'Death Note Vol. 4', 'Tsugumi Ōba', 'La Oficina Central de Investigación encuentra un segundo Kira, y para atraparlo deciden pedir la ayuda de Light Yagami, a quien por sugerencia de L, llaman a trabajar en las oficinas.', 2005, 2, 3200, 0);
        
        -- --------------------------------------------------------
        
        --
        -- Estructura de tabla para la tabla `usuarios`
        --
        
        CREATE TABLE `usuarios` (
          `id` int(11) NOT NULL,
          `nombre_usuario` varchar(50) NOT NULL,
          `contrasenia` varchar(250) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        
        --
        -- Volcado de datos para la tabla `usuarios`
        --
        
        INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasenia`) VALUES
        (1, 'webadmin', '$2y$10\$ztUuk38KaDsp/yCmrF0/w.3TSRvvzp153ZLOjT3hj9cF6xFcDnrDK');
        
        --
        -- Índices para tablas volcadas
        --
        
        --
        -- Indices de la tabla `generos`
        --
        ALTER TABLE `generos`
          ADD PRIMARY KEY (`id_genero`);
        
        --
        -- Indices de la tabla `libros`
        --
        ALTER TABLE `libros`
          ADD PRIMARY KEY (`id`),
          ADD KEY `id_genero` (`genero`);
        
        --
        -- Indices de la tabla `usuarios`
        --
        ALTER TABLE `usuarios`
          ADD PRIMARY KEY (`id`);
        
        --
        -- AUTO_INCREMENT de las tablas volcadas
        --
        
        --
        -- AUTO_INCREMENT de la tabla `generos`
        --
        ALTER TABLE `generos`
          MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
        
        --
        -- AUTO_INCREMENT de la tabla `libros`
        --
        ALTER TABLE `libros`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
        
        --
        -- AUTO_INCREMENT de la tabla `usuarios`
        --
        ALTER TABLE `usuarios`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
        
        --
        -- Restricciones para tablas volcadas
        --
        
        --
        -- Filtros para la tabla `libros`
        --
        ALTER TABLE `libros`
          ADD CONSTRAINT `genero_fk` FOREIGN KEY (`genero`) REFERENCES `generos` (`id_genero`);
        COMMIT;
      END;
      $this->db->query($sql);
    }
  }
}