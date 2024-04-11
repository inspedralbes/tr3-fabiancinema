const url = 'http://localhost:8000/api';
// const url = 'http://fabiancine.a21fabrolfer.daw.inspedralbes.cat/back/laravel/public/api';

// Función para obtener todas las películas
export function obtenerPeliculas() {
    return new Promise((resolve, reject) => {
        fetch(`${url}/peliculas`)
            .then(response => {
                if (response.status == 200) {
                    console.log("🇸 🇵 🇴 🇷 🇹 🇮 🇳 🇬  🇩 🇪  🇬 🇮 🇯 🇴 🇳");
                    return response.json();
                } else {
                    reject('Error al obtener las películas');
                }
            }).then(data => {
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

// Función para obtener una sesión por su ID
export function obtenerSesion(id) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/sesiones/${id}`)
            .then(response => {
                if (response.status == 200) {
                    console.log("🇷 🇦 🇨 🇮 🇳 🇬  🇩 🇪  🇸 🇦 🇳 🇹 🇦 🇳 🇩 🇪 🇷", id);
                    return response.json();
                } else {
                    reject('Error al obtener la sesión');
                }
            }).then(data => {
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

// Función para actualizar el estado de los asientos
export function actualizarEstadoAsientos(id) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/entradas`)
            .then(response => {
                if (response.status == 200) {
                    return response.json();
                } else {
                    reject('Error al obtener los asientos ocupados');
                }
            }).then(data => {
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

// Función para comprar entradas
export function comprarEntradasFetch(data) {
    console.log("🇩 🇦 🇹 🇦 🇸", data);
    return new Promise((resolve, reject) => {
        fetch(`${url}/entradas`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => {
            if (response.status == 200) {
                console.log("🇨 🇦 🇷 🇹 🇦 🇬 🇪 🇳 🇦");
                return response.json();
            } else {
                reject('Error al comprar las entradas');
            }
        }).then(data => {
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

// Función para crear una película
export function crearPelicula(peliculaData) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/peliculas`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(peliculaData)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al crear la película');
            }
        }).then(data => {
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

// Función para actualizar una película
export function actualizarPelicula(id, peliculaData) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/peliculas/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(peliculaData)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al actualizar la película');
            }
        }).then(data => {
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

// Función para eliminar una película
export function eliminarPelicula(id) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/peliculas/${id}`, {
            method: 'DELETE'
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al eliminar la película');
            }
        }).then(data => {
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}
