export default defineNuxtConfig({
    devtools: { enabled: true },
    modules: [
        '@pinia/nuxt',
    ],
    css: [
    'normalize.css', // Aquí agregas la ruta de Normalize CSS
    // Otros estilos que desees incluir en tu aplicación
  ],
    serverMiddleware: [
        function (req, res, next) {
            // Configuración de los encabezados CORS
            res.setHeader('Access-Control-Allow-Origin', '*');
            res.setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            res.setHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
            next();
        }
    ]
})
