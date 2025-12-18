addEventListener("DOMContentLoaded", () => {
    let coloresSeleccionados = document.getElementsByName("colores[]")

    for(let colorSeleccionado of coloresSeleccionados){
        colorSeleccionado.classList.add("color"+colorSeleccionado.value)

        colorSeleccionado.addEventListener("change", () => {
            colorSeleccionado.classList.add("color"+colorSeleccionado.value)
        })
    }
})