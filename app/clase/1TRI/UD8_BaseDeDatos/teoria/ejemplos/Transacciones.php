<?php
/**
 * TRANSACCIONES EN MYSQLI (Garantía de Atomicidad)
 *
 * Una transacción es un conjunto de operaciones que se ejecutan como una unidad (propiedad atómica - A de ACID):
 * - O se ejecutan TODAS correctamente (Commit)
 * - O NO se ejecuta NINGUNA (Rollback)
 *
 * Conceptos clave:
 * - autocommit(false): Desactivar la auto-confirmación, iniciando el control de la transacción.
 * - commit(): Confirmar y hacer permanentes todos los cambios desde el inicio de la transacción.
 * - rollback(): Deshacer y revertir todos los cambios al estado inicial.
 * - Útil para operaciones que deben ser atómicas (p.ej., transferencia de dinero).
 */

use mysqli;
use mysqli_sql_exception;

class Transacciones {
    private mysqli $con;

    // Se asume que la conexión $con se pasa desde fuera (mejor práctica)
    public function __construct(mysqli $con) {
        $this->con = $con;

        // NOTA: Es crucial que las tablas usen el motor InnoDB para que las transacciones funcionen.
    }

    /**
     * EJEMPLO 1: Transferencia bancaria (caso clásico)
     *
     * Si falla cualquiera de las dos operaciones (descontar u sumar), ambas deben cancelarse
     * para mantener la integridad de los datos (Atomicidad).
     */
    public function transferenciaBancaria(
        string $cuentaOrigen,
        string $cuentaDestino,
        float $cantidad
    ): bool|string {

        echo "<h3>Transferencia de $cantidad€</h3>";
        echo "Origen: $cuentaOrigen → Destino: $cuentaDestino<br><br>";

        // PASO 1: Desactivar autocommit
        // Los cambios quedan pendientes (pendientes de commit o rollback)
        $this->con->autocommit(false);

        try {
            // OPERACIÓN 1: Descontar de cuenta origen
            $stmt1 = $this->con->prepare(
                "UPDATE cuentas SET saldo = saldo - ? WHERE numero_cuenta = ?"
            );
            // Uso de prepared statements (ds: double, string) para seguridad
            $stmt1->bind_param('ds', $cantidad, $cuentaOrigen);

            if (!$stmt1->execute()) {
                // Si la ejecución SQL falla, lanzamos una excepción para ir al catch/rollback
                throw new mysqli_sql_exception("Error descuento: " . $stmt1->error);
            }

            if ($stmt1->affected_rows === 0) {
                // La cuenta no existe o no se actualizó (p.ej. saldo insuficiente si se usa CHECK constraint)
                // Decidimos abortar la transacción: lanzamos una excepción.
                throw new mysqli_sql_exception("Cuenta origen no existe o saldo insuficiente");
            }

            echo "✓ Descontado $cantidad€ de $cuentaOrigen<br>";
            $stmt1->close();

            // SIMULACIÓN: Punto crítico. Si el script se detiene aquí, el ROLLBACK implícito de MySQL se encargará
            // de revertir el descuento al cerrarse la conexión.

            // OPERACIÓN 2: Sumar a cuenta destino
            $stmt2 = $this->con->prepare(
                "UPDATE cuentas SET saldo = saldo + ? WHERE numero_cuenta = ?"
            );
            $stmt2->bind_param('ds', $cantidad, $cuentaDestino);

            if (!$stmt2->execute()) {
                throw new mysqli_sql_exception("Error ingreso: " . $stmt2->error);
            }

            if ($stmt2->affected_rows === 0) {
                // Si la cuenta destino no existe, abortamos.
                throw new mysqli_sql_exception("Cuenta destino no existe");
            }

            echo "✓ Sumado $cantidad€ a $cuentaDestino<br>";
            $stmt2->close();

            // PASO 2: Si t0do fue bien, CONFIRMAR con commit()
            // Esto hace permanentes todos los cambios pendientes.
            $this->con->commit();
            echo "<br><strong>✓ TRANSACCIÓN COMPLETADA</strong><br>";

            // Reactivar autocommit para futuras operaciones fuera de transacciones explícitas
            $this->con->autocommit(true);
            return true;

        } catch (mysqli_sql_exception $e) {
            // PASO 3: Si hubo error, DESHACER con rollback()
            // Garantiza la Atomicidad: revierte la OPERACIÓN 1 (el descuento) aunque la OPERACIÓN 2 haya fallado.
            $this->con->rollback();

            echo "<br><strong>✗ ERROR: Transacción cancelada</strong><br>";
            echo "Motivo: " . $e->getMessage() . "<br>";
            echo "La base de datos queda como estaba (Rollback ejecutado)<br>";

            // Reactivar autocommit
            $this->con->autocommit(true);
            return $e->getMessage();
        }
    }

    /**
     * EJEMPLO 2: Inserción múltiple (t0do o nada)
     *
     * Insertar un pedido con sus líneas de detalle.
     * Si falla una línea (p.ej., por una clave foránea inexistente), se cancela todo,
     * incluyendo la cabecera del pedido que ya se había insertado.
     */
    public function insertarPedidoCompleto(
        int $idCliente,
        array $lineasPedido
    ): bool|string {

        echo "<h3>Insertar pedido con " . count($lineasPedido) . " líneas</h3>";

        // Desactivar autocommit
        $this->con->autocommit(false);

        try {
            // 1. Insertar cabecera del pedido
            $stmt = $this->con->prepare(
                "INSERT INTO pedidos (id_cliente, fecha) VALUES (?, NOW())"
            );
            $stmt->bind_param('i', $idCliente);

            if (!$stmt->execute()) {
                // Error si el cliente no existe (si id_cliente es FK)
                throw new mysqli_sql_exception("Error pedido: " . $stmt->error);
            }

            $idPedido = $stmt->insert_id;
            echo "✓ Pedido #$idPedido creado<br>";
            $stmt->close();

            // 2. Insertar líneas del pedido (bucle)
            $stmtLinea = $this->con->prepare(
                "INSERT INTO lineas_pedido (id_pedido, producto, cantidad, precio) 
                 VALUES (?, ?, ?, ?)"
            );

            foreach ($lineasPedido as $linea) {
                // Reutilizamos el prepared statement
                $stmtLinea->bind_param(
                    'isid', // i: id_pedido, s: producto, i: cantidad, d: precio
                    $idPedido,
                    $linea['producto'],
                    $linea['cantidad'],
                    $linea['precio']
                );

                if (!$stmtLinea->execute()) {
                    // Si falla una línea, lanzamos excepción y cancelamos t0do el pedido
                    throw new mysqli_sql_exception(
                        "Error línea {$linea['producto']}: " . $stmtLinea->error
                    );
                }

                echo "✓ Línea añadida: {$linea['producto']}<br>";
            }
            $stmtLinea->close();

            // 3. Confirmar todo
            $this->con->commit();
            echo "<br><strong>✓ PEDIDO COMPLETO GUARDADO</strong><br>";

            $this->con->autocommit(true);
            return true;

        } catch (mysqli_sql_exception $e) {
            // Si falla cualquier operación (cabecera o línea), cancelar todo
            $this->con->rollback();

            echo "<br><strong>✗ PEDIDO CANCELADO</strong><br>";
            echo "Error: " . $e->getMessage() . "<br>";

            $this->con->autocommit(true);
            return $e->getMessage();
        }
    }

    /**
     * EJEMPLO 3: Gestión de stock (reserva y venta) - CONCURRENCIA
     *
     * Usamos el bloqueo de filas (SELECT... FOR UPDATE) para prevenir que dos
     * transacciones simultáneas vendan el mismo stock.
     */
    public function procesarVenta(
        string $codProducto,
        int $cantidad,
        string $cliente
    ): bool|string {

        echo "<h3>Procesar venta</h3>";
        echo "Producto: $codProducto | Cantidad: $cantidad | Cliente: $cliente<br><br>";

        $this->con->autocommit(false);

        try {
            // 1. Verificar stock disponible y BLOQUEAR FILA
            $stmt = $this->con->prepare(
                "SELECT unidades FROM stock WHERE producto = ? FOR UPDATE" // Bloqueo exclusivo
            );
            // 'FOR UPDATE' asegura que, hasta que se haga commit o rollback,
            // ninguna otra transacción pueda leer o modificar esa fila de stock.

            $stmt->bind_param('s', $codProducto);
            $stmt->execute();
            $stmt->bind_result($stockActual);
            $stmt->fetch();
            $stmt->close();

            if ($stockActual === null) {
                throw new mysqli_sql_exception("Producto no encontrado");
            }

            if ($stockActual < $cantidad) {
                throw new mysqli_sql_exception(
                    "Stock insuficiente (disponible: $stockActual)"
                );
            }

            echo "✓ Stock verificado: $stockActual unidades<br>";

            // 2. Descontar stock (la fila ya está bloqueada)
            $stmt = $this->con->prepare(
                "UPDATE stock SET unidades = unidades - ? WHERE producto = ?"
            );
            $stmt->bind_param('is', $cantidad, $codProducto);

            if (!$stmt->execute()) {
                throw new mysqli_sql_exception("Error actualizando stock");
            }

            echo "✓ Stock actualizado<br>";
            $stmt->close();

            // 3. Registrar venta
            $stmt = $this->con->prepare(
                "INSERT INTO ventas (producto, cantidad, cliente, fecha) 
                 VALUES (?, ?, ?, NOW())"
            );
            $stmt->bind_param('sis', $codProducto, $cantidad, $cliente);

            if (!$stmt->execute()) {
                throw new mysqli_sql_exception("Error registrando venta");
            }

            echo "✓ Venta registrada<br>";
            $stmt->close();

            // t0do correcto, confirmar (libera el bloqueo de la fila de stock)
            $this->con->commit();
            echo "<br><strong>✓ VENTA PROCESADA EXITOSAMENTE</strong><br>";

            $this->con->autocommit(true);
            return true;

        } catch (mysqli_sql_exception $e) {
            // Error: deshacer t0do (libera el bloqueo y revierte el descuento)
            $this->con->rollback();

            echo "<br><strong>✗ VENTA CANCELADA</strong><br>";
            echo "Error: " . $e->getMessage() . "<br>";

            $this->con->autocommit(true);
            return $e->getMessage();
        }
    }

    /**
     * EJEMPLO 4: Transacción manual con begin_transaction()
     *
     * Forma alternativa más explícita a autocommit(false) (disponible en PHP >= 5.5).
     */
    public function transaccionExplicita(): bool|string {
        echo "<h3>4. Transacción explícita con begin_transaction()</h3>";
        try {
            // Iniciar transacción explícitamente (implica autocommit(false))
            $this->con->begin_transaction();

            // Operaciones...
            $this->con->query("INSERT INTO log (mensaje) VALUES ('Transacción iniciada')");

            // Simulación de una operación fallida
            // $this->con->query("SELECT * FROM tabla_inexistente");

            // Confirmar
            $this->con->commit();
            echo "✓ Transacción explícita confirmada.<br>";
            return true;

        } catch (mysqli_sql_exception $e) {
            // El error se captura y se revierte
            $this->con->rollback();
            echo "✗ Transacción explícita revertida. Error: " . $e->getMessage() . "<br>";
            return $e->getMessage();
        }
        // NOTA: Con begin_transaction(), la reconexión implícita de autocommit(true) no es estrictamente
        // necesaria porque el modo de autoconfirmación se mantiene por defecto a TRUE al finalizar,
        // pero es buena práctica gestionarlo.
    }

    public function __destruct() {
        if (isset($this->con)) {
            $this->con->close();
        }
    }
}

// EJEMPLOS DE USO
echo "<h2>Transacciones en MySQLi</h2>";

// ASUMIMOS que se ha establecido una conexión $con a la base de datos
// y se pasa al constructor de Transacciones.
// $con = new mysqli("localhost", "root", "root", "dwes");
// $db = new Transacciones($con);

/*
// 1. Transferencia bancaria exitosa
echo "<h2>Ejemplo 1: Transferencia bancaria</h2>";
$db->transferenciaBancaria('ES001122', 'ES003344', 100.00);

// 2. Insertar pedido completo
echo "<hr><h2>Ejemplo 2: Pedido completo</h2>";
$lineas = [
    ['producto' => 'PROD1', 'cantidad' => 2, 'precio' => 99.99],
    ['producto' => 'PROD2', 'cantidad' => 1, 'precio' => 149.99]
];
$db->insertarPedidoCompleto(123, $lineas);

// 3. Procesar venta
echo "<hr><h2>Ejemplo 3: Venta con control de stock</h2>";
$db->procesarVenta('PAPNOTE01', 5, 'Juan Pérez');

// 4. Transacción explícita
echo "<hr>";
$db->transaccionExplicita();
*/


/**
 * RESUMEN TRANSACCIONES (ACID: Atomicidad, Consistencia, Aislamiento, Durabilidad):
 *
 * COMANDOS PRINCIPALES:
 * - $con->autocommit(false)       : Inicia la gestión manual.
 * - $con->begin_transaction()     : Inicio explícito (alternativa moderna).
 * - $con->commit()                : Hace los cambios permanentes (Durabilidad).
 * - $con->rollback()              : Revierte los cambios al estado inicial (Atomicidad).
 *
 * PROPIEDADES AVANZADAS:
 * - SELECT ... FOR UPDATE: Impone un bloqueo exclusivo en filas para garantizar
 * el Aislamiento (Isolation) y evitar condiciones de carrera (Race Conditions)
 * en operaciones críticas como la gestión de stock.
 *
 * PATRÓN TÍPICO DE MANEJO:
 * try {
 * $con->autocommit(false);
 * // ... operaciones ...
 * $con->commit();
 * } catch (mysqli_sql_exception $e) {
 * $con->rollback();
 * } finally {
 * // Siempre restaurar el estado, aunque el script termine aquí.
 * $con->autocommit(true);
 * }
 *
 * CASOS DE USO:
 * - Transferencias bancarias.
 * - Creación de documentos con múltiples registros asociados (Pedidos, Facturas, etc.).
 * - Gestión de recursos finitos (Stock, Reservas, etc.).
 *
 * IMPORTANTE:
 * - Solo funciona con motores transaccionales (principalmente **InnoDB**).
 * - Siempre usar **try-catch** para capturar errores y asegurar el rollback.
 */
?>