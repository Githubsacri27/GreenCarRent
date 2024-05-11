// Escucha el evento de carga para inicializar los valores de los inputs de fecha
window.addEventListener('load', function() {
    let today = new Date();
    let nextDay = getNextDay(today);

    // Obtiene los elementos de entrada de fecha
    let fechaRecogida = document.getElementById('fechaRecogida');
    let fechaEntrega = document.getElementById('fechaEntrega');

    // Si fechaRecogida existe, establece los atributos min y max
    if (fechaRecogida) {
        // Establece atributos mínimos y máximos para fechaRecogida
        fechaRecogida.min = dateToString(nextDay);
        let oneYearAfterToday = addYear(today, 1);
        fechaRecogida.max = dateToString(oneYearAfterToday);

        // Escucha el evento de cambio en fechaRecogida y actualiza fechaEntrega
        fechaRecogida.addEventListener('change', function() {
            let nextDay = getNextDay(new Date(fechaRecogida.value));
            if (fechaEntrega) {
                fechaEntrega.min = dateToString(nextDay);
                let fechaEntregaValue = new Date(fechaEntrega.value);
                
                // Si `fechaEntrega` es menor que `fechaRecogida`, ajusta `fechaEntrega`
                if (nextDay > fechaEntregaValue) {
                    fechaEntrega.value = dateToString(nextDay);
                }
            }
        });
    }

    // Si `fechaEntrega` existe en el DOM, establece los atributos `min` y `max`
    if (fechaEntrega) {
        // Establece atributos mínimos y máximos para `fechaEntrega`
        let nextNextDay = getNextDay(nextDay);
        fechaEntrega.min = dateToString(nextNextDay);
        let threeYearsAfterToday = addYear(today, 3);
        fechaEntrega.max = dateToString(threeYearsAfterToday);
    }
});
