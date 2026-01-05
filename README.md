# Ejercicios PHP de 2DAW

La carpeta app contiene el codigo fuente de todos los ejercicios, además de la teoria correspondiente en markdown.  

Se pueden visualizar estos ejercicios en acción en el siguiente enlace (menos los que dependen de composer y de una DB):  
https://php2daw.page.gd/

---

## GitHub Actions

### Despliegue automatico a InfinityFree:

> Esta explicación es debido a una tarea de la asignatura de **despliegue de aplicaciones web** sobre el análisis de GitHub Actions, donde he elegido la opcion de "_explicacion de un action de un tercero_".

He implementado un sistema para que, cada vez que suba un ejercicio nuevo al repositorio, se publique automáticamente en mi hosting gratuito (InfinityFree).

### 1. Descripción de la Action.

He utilizado la action **[FTP-Deploy-Action](https://github.com/marketplace/actions/ftp-deploy)** creada por *SamKirkland*.

* **¿Qué problema resuelve?** Automatiza la subida de archivos vía FTP. Yo lo he usado para tener una página web actualizada automáticamente al día con el repositorio donde cualquiera puede visualizar y ejecutar los ejercicios.
* **¿Por qué esta action?** Como uso **InfinityFree** (un hosting gratuito), no tengo acceso SSH ni herramientas avanzadas de despliegue. Solo tengo acceso FTP. Esta Action es la más popular y sencilla para conectar GitHub con un servidor FTP estándar.

### 2. Ubicación del workflow.

El archivo de configuración se encuentra en la ruta estándar que **especifica GitHub** para la ubicación de los workflows:
`./.github/workflows//ftp_deploy.yaml`

### 3. Explicación paso a paso del código.

**a) Disparador (`on`)**

```yaml
on:
  push:
    branches: ["main"]
  workflow_dispatch:

```
Esto le dice a GitHub que ejecute la acción **solo** cuando hago un `push` a la rama `main`.
También he añadido `workflow_dispatch` para poder lanzarla manualmente desde la web de GitHub si hiciera falta.

**b) El trabajo (`jobs`)**
```yaml
runs-on: ubuntu-latest
```
La acción se ejecuta en una máquina virtual de Linux que nos presta GitHub.

**c) Los pasos (`steps`)**
```yaml
    steps:
      - name: Get Latest Code
        uses: actions/checkout@v4

      - name: Sync Files
        uses: SamKirkland/FTP-Deploy-Action@v4.3.6
        with:
          server: ftpupload.net
          username: ${{ secrets.ftp_username }}
          password: ${{ secrets.ftp_password }}
          protocol: ftp
          port: 21
          local-dir: ./app/
          server-dir: ./php2daw.page.gd/htdocs/
          exclude: |
            **/.git*
            **/.git*/**
            **/vendor
            **/vendor/**
```

El trabajo tiene solo dos pasos:

1. **Get Latest Code:**
Lo primero que hace la máquina virtual es descargarse mi código del repositorio. Si no hace esto, no tiene archivos que subir.

3. **Sync Files:**
Aquí es donde uso la action de terceros. Le paso mis credenciales para que se conecte y suba los archivos.

**Secrets:** IMPORTANTE. No he puesto mi contraseña en el código. Uso `${{ secrets.ftp_password }}` que lee las variables ocultas que he configurado en los ajustes del repositorio.
**Directorios:** Le indico que coja los archivos de la carpeta app (`./app/`) y los suba en la carpeta pública del servidor del dominio php2daw (`/php2daw.page.gd/htdocs/`).

### 4. Modificaciones y optimización.

Aunque he usado una action del marketplace, le he hecho unos ajustes.

El principal problema que tuve es que el protocolo FTP es muy lento subiendo archivos pequeños. Al usar Composer en algunos ejercicios se genera la carpeta `vendor` que tiene miles de archivos.

Para solucionarlo, he añadido esta configuración de exclusión (`exclude`):

```yaml
exclude: |
  **/.git*
  **/.git*/**
  **/vendor/**

```

Le dice a la action que suba mis ejercicios, pero que ignore la carpeta vendor y la carpeta .git**. Esto hace que el tiempo de ejeccucion del workflow baje mucho pero como consecuencia los ejercicios que usan Composer no van en la web.

### 5. Ejecución y evidencias.

La action se ejecuta sola. En la pestaña "Actions" del repositorio se puede ver el historial de despliegues. Si sale el tick verde ✅, significa que los archivos ya están actualizados en la web de InfinityFree.
