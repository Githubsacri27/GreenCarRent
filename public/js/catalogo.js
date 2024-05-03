// Catálogo
window.addEventListener('load', function() {
    const filterButton = document.getElementById('filterButton');
    const toggleFilter = document.getElementById('toggle-filter');

    // Si el botón de filtro existe, añade un evento de clic
    if (filterButton) {
        filterButton.addEventListener('click', function() {
            // Alterna la visibilidad del filtro
            toggleFilter.style.display = toggleFilter.style.display === 'none' ? 'block' : 'none';
        });
    }
});

// Entrada de rango doble
window.addEventListener('load', function() {
    const rangeInput = document.querySelectorAll('.range-input input');
    const priceInput = document.querySelectorAll('.price-input input');
    const progress = document.querySelector('.slider .progress');

    // Paso para el deslizador de rango doble
    let step = 50;

    // Tamaño inicial del elemento de progreso
    function setMinDefaultValue(min) {
        rangeInput[0].value = min;
        priceInput[0].value = min;
        progress.style.left = ((min / rangeInput[0].max) * 100) + '%';
    }

    function setMaxDefaultValue(max) {
        rangeInput[1].value = max;
        priceInput[1].value = max;
        progress.style.right = 100 - (max / rangeInput[1].max) * 100 + '%';
    }

    // Establece valores por defecto si los inputs de precio están vacíos
    if (priceInput[0].value === '' && priceInput[1].value === '') {
        setMinDefaultValue(0);
        setMaxDefaultValue(5000);
    } else {
        setMinDefaultValue(priceInput[0].value);
        setMaxDefaultValue(priceInput[1].value);
    }

    // Escucha los cambios en los inputs numéricos y actualiza el deslizador y los valores
    priceInput.forEach(input => {
        input.addEventListener('input', function(e) {
            let minPrice = priceInput[0].valueAsNumber;
            let maxPrice = priceInput[1].valueAsNumber;

            if (minPrice >= 0 && maxPrice > 0) {
                if ((maxPrice - minPrice >= step) && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === 'input-min') {
                        rangeInput[0].value = minPrice;
                        progress.style.left = ((minPrice / rangeInput[0].max) * 100) + '%';
                    } else if (e.target.className === 'input-max') {
                        rangeInput[1].value = maxPrice;
                        progress.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + '%';
                    }
                }
            }
        });
    });

    // Escucha los cambios en los deslizadores y actualiza los inputs de precio y el progreso
    rangeInput.forEach(input => {
        input.addEventListener('input', function(e) {
            let minVal = rangeInput[0].valueAsNumber;
            let maxVal = rangeInput[1].valueAsNumber;

            if ((maxVal - minVal) < step) {
                if (e.target.className === 'range-min') {
                    rangeInput[0].value = maxVal - step;
                } else {
                    rangeInput[1].value = minVal + step;
                }
            } else {
                priceInput[0].value = minVal;
                priceInput[1].value = maxVal;
                progress.style.left = ((minVal / rangeInput[0].max) * 100) + '%';
                progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + '%';
            }
        });
    });

    // Escucha el evento "focusout" en el input de precio mínimo y establece valores por defecto
    document.getElementById('priceMin').addEventListener('focusout', function() {
        let minPrice = priceInput[0].valueAsNumber;
        let maxPrice = priceInput[1].valueAsNumber;

        if (maxPrice - minPrice <= step || minPrice < 0 || esNaN(minPrice)) {
            setMinDefaultValue(0);
        }
    });

    // Escucha el evento "focusout" en el input de precio máximo y establece valores por defecto
    document.getElementById('priceMax').addEventListener('focusout', function() {
        let minPrice = priceInput[0].valueAsNumber;
        let maxPrice = priceInput[1].valueAsNumber;

        if (maxPrice - minPrice <= step || maxPrice > rangeInput[1].max || esNaN(maxPrice)) {
            setMaxDefaultValue(5000);
        }
    });
});

// Entrada de fechas

// Función para obtener el siguiente día de la semana
function getNextDay(day) {
    let newDay = new Date(day.getTime());
    newDay.setDate(newDay.getDate() + 1);
    return newDay;
}

// Formato de salida de la fecha como YYYY-mm-dd
function dateToString(date) {
    let string = date.getFullYear() + '-';
    let month = date.getMonth() + 1;
    let day = date.getDate();

    if (month < 10) {
        string += '0' + month + '-';
    } else {
        string += month + '-';
    }

    if (day < 10) {
        string += '0' + day;
    } else {
        string += day;
    }

    return string;
}

// Añade años a una fecha
function addYear(date, year) {
    let newDate = new Date(date.getTime());
    newDate.setFullYear(newDate.getFullYear() + year);
    return newDate;
}

// Escucha el evento de carga para inicializar los valores de los inputs de fecha
window.addEventListener('load', function() {
    let today = new Date();
    let nextDay = getNextDay(today);

    let fechaRecogida = document.getElementById('fechaRecogida');
    let fechaEntrega = document.getElementById('fechaEntrega');

    // Establece atributos mínimos y máximos para fechaRecogida
    fechaRecogida.min = dateToString(nextDay);
    let OneYearAfterToday = addYear(today, 1);
    fechaRecogida.max = dateToString(OneYearAfterToday);

    // Establece atributos mínimos y máximos para fechaEntrega
    let nextNextDay = getNextDay(nextDay);
    fechaEntrega.min = dateToString(nextNextDay);
    let ThreeYearAfterToday = addYear(today, 3);
    fechaEntrega.max = dateToString(ThreeYearAfterToday);

    // Escucha el evento de cambio en fechaRecogida y actualiza fechaEntrega
    fechaRecogida.addEventListener('change', function() {
        let nextDay = getNextDay(new Date(fechaRecogida.value));
        fechaEntrega.min = dateToString(nextDay);
        let fechaEntregaValue = new Date(fechaEntrega.value);

        if (nextDay > fechaEntregaValue) {
            fechaEntrega.value = dateToString(nextDay);
        }
    });
});