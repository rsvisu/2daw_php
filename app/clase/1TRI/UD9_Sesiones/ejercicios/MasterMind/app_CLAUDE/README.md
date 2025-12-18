# Juego MasterMind - Proyecto DAW

## Descripción
Este es un juego de MasterMind donde el jugador debe adivinar una secuencia de 4 colores diferentes en máximo 14 intentos.

## Estructura del Proyecto
```
app/
├── src/
│   ├── Clave.php          # Gestiona la clave secreta
│   ├── Jugada.php         # Evalúa las jugadas del usuario
│   └── Plantilla.php      # Genera formularios HTML
├── css/
│   └── estilo.css         # Estilos del juego
├── vendor/                # Dependencias de Composer
├── composer.json          # Configuración de Composer
├── controlador.php        # Lógica principal del juego
├── index.php             # Página de inicio
├── jugar.php             # Interface del juego
└── finJuego.php          # Página de fin de partida
```

## Instalación
1. Ejecutar `composer update` en el directorio raíz
2. Configurar servidor web (Apache/Nginx)
3. Acceder a `index.php`

## Tecnologías Utilizadas
- PHP 7.4+
- Composer (Autoload PSR-4)
- Sesiones PHP
- HTML5/CSS3
- JavaScript (para cambios visuales)