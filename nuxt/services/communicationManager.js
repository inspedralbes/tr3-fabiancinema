const url = 'http://localhost:8000/api';

export function obtenerPeliculas() {
    return new Promise((resolve, reject) => {
        fetch(`${url}/peliculas`)
            .then(response => {
                if (response.status == 200) {
                    return response.json();
                } else {
                    reject('Error al obtener las peliculas');
                }
            }).then(data => {
                JSON.stringify(data);
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

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
                JSON.stringify(data);
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

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
                JSON.stringify(data);
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

export function comprarEntradas(data) {
    console.log("🇩 🇦 🇹 🇦 🇸", data);
    return new Promise((resolve, reject) => {
        fetch(`${url}/entradas`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => {
            console.log("🇷 🇪 🇸 🇵 🇴 🇳 🇸 🇪", response);
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al comprar las entradas');
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}
