<?php

namespace Class\View;

use Class\DataBase\BaseDatos;

class Plantilla
{
    // Funciones
    public static function getHtmlTableOfContentTable(string $tabla, BaseDatos $conexion): string
    {
        $contentTable = $conexion->getContentTable($tabla);

        if (empty($contentTable)) {
            return "(vacío)";
        }

        // Filas cabeceras de la tabla.
        $htmlTableHeader = "";
        foreach (array_keys($contentTable[0]) as $key) {
            $htmlTableHeader .= "<th>$key</th>\n";
        }

        // Contenido de la tabla.
        $htmlTableContent = "";
        foreach ($contentTable as $fila) {
            $htmlTableContent .= "<tr>\n";
            foreach ($fila as $valor) {
                $htmlTableContent .= "<td>$valor</td>\n";
            }
            $htmlTableContent .= "</tr>\n";
        }

        // Construimos el HTML final.
        $html = <<<HTML
        <table>
            <thead>
                $htmlTableHeader
            </thead>
            <tbody>
                $htmlTableContent
            </tbody>
        </table>
        HTML;

        // Devolvemos el HTML.
        return $html;
    }

    public static function getHeader() : string {
        // TODO
    }
}
