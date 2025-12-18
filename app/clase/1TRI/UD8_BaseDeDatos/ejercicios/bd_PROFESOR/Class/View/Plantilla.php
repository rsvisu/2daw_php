<?php
namespace Class\View;

class Plantilla{

    /**
     * @param array $filas con el contenido de la tabla o array vacío si no hay dats
     * @param string $tabla El de la tabla
     * @param array $campos Los nombres de los campos o atributos de la tabla
     * @return string un texto diciendo que no hay datos o una tabla html con el contendio de las filas
     */
    public static function  getContentTableToHtml( string $tabla, array $campos,array $filas):string {        //Si no hay datos retor no un strign informado
        if (count($filas)==0)
            return "<h1>La tabla no tiene datos</h1>";
        $html="<table>";
        $html.=Plantilla::getTituloTabla($tabla, count($campos));
        $html.=self::getCabeceraCampos($campos);
        $html.=self::getContentFilas($filas);
        $html.="</table>";
        return $html;
}

private static function getTituloTabla(string $tabla, int $span):string {
        return "<caption colspan='$span'>$tabla</caption>";
}
private static function getCabeceraCampos(array $campos):string {
        $cabecera_html= "<tr>";
        foreach ($campos as $campo) {
            $cabecera_html .= "<th>$campo</th>";
        }
        $cabecera_html .= "</tr>";
        return $cabecera_html;
}
private static function getContentFilas(array $filas):string {
        $html="";
        foreach ($filas as $fila) {
            $html.="<tr>";
            foreach ($fila as $campo) {
                $html .= "<td>$campo</td>";
            }
            $html.="</tr>";
        }
        return $html;
}

    public static function getHeader(string $usuario, string $page)
    {
        $header_html  = "<div class='w-full h-12 bg-red-300 flex flex-row justify-end items-center px-5 gap-4 bg-gray-100 border-b'>";
        $header_html.="<span class='text-bold'> $usuario</span>";
        $header_html.="<form method='post' action='$page'>";
        $header_html.="<input class='btn btn-primary' type='submit' name='submit' value='Logout'>";
        $header_html.="</form>";
        $header_html.="</div>";
        return $header_html;

    }


}

