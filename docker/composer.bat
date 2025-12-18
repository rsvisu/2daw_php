@ECHO OFF

REM --- Deteccion de Ayuda del Script ---
REM El parametro /I hace que no importen mayusculas o minusculas
IF /I "%1"=="/help" GOTO :ShowHelp
IF /I "%1"=="/h"    GOTO :ShowHelp
IF /I "%1"=="/?"    GOTO :ShowHelp
IF /I "%1"=="help"  GOTO :ShowHelp

REM --- Ejecucion normal ---
REM Si no pides ayuda del script, se manda todo a Docker tal cual
docker compose exec web composer %*

REM Salimos con el mismo codigo de error que de Docker
EXIT /B %ERRORLEVEL%

:ShowHelp
CLS
ECHO.
ECHO ==============================================================
ECHO                    COMPOSER DOCKER WRAPPER
ECHO ==============================================================
ECHO.
ECHO USO:
ECHO   .\composer.bat [argumentos de composer]
ECHO.
ECHO COMANDOS DE AYUDA DEL SCRIPT:
ECHO   .\composer.bat /help    Muestra esta pantalla
ECHO   .\composer.bat /h       Muestra esta pantalla
ECHO   .\composer.bat /?       Muestra esta pantalla
ECHO.
ECHO EJEMPLOS PRACTICOS:
ECHO   1. Instalar todo:
ECHO      .\composer.bat install
ECHO.
ECHO   2. Instalar libreria en una SUBCARPETA (Importante):
ECHO      .\composer.bat -d backend require monolog/monolog
ECHO.
ECHO   3. Ver la ayuda oficial de Composer (no la del script):
ECHO      .\composer.bat --help
ECHO ==============================================================
GOTO :EOF