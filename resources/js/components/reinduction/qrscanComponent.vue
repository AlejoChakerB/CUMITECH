<template>
    <div>
        <div class="scan"">
            <qrcode-stream @decode="onDecode" @init="onInit"></qrcode-stream>
        </div>
        <p v-if="result" class="success-message">Código QR escaneado correctamente
            <br>
            Esperar aprobación por parte del presentador
        </p>
        <div v-if="error" class="error-message">
            {{ error }}<br>
            Por favor contacte con el asesor
        </div>
    </div>
</template>

<script>
import { QrcodeStream } from 'vue-qrcode-reader'
import axios from 'axios';

export default {
    name: 'QRCodeScanner',
    props: {
        route: String,
        user: Number
    },
    components: {
        QrcodeStream
    },
    data() {
        return {
            result: '',
            error: ''
        }
    },
    methods: {
        onDecode(content) {
            this.result = content
            this.sendData(content);
        },
        async onInit(promise) {
            this.error = ''
            try {
                await promise
            } catch (error) {
                if (error.name === 'NotAllowedError') {
                    this.error = 'ERROR: Debes dar permiso para acceder a la cámara'
                } else if (error.name === 'NotFoundError') {
                    this.error = 'ERROR: No se encontró ninguna cámara'
                } else if (error.name === 'NotSupportedError') {
                    this.error = 'ERROR: La página no está siendo servida a través de HTTPS'
                } else if (error.name === 'NotReadableError') {
                    this.error = 'ERROR: La cámara ya está siendo utilizada'
                } else if (error.name === 'OverconstrainedError') {
                    this.error = 'ERROR: Las restricciones de la cámara son demasiado específicas'
                } else if (error.name === 'StreamApiNotSupportedError') {
                    this.error = 'ERROR: El navegador no soporta la API de transmisión'
                } else {
                    this.error = `ERROR: Se produjo un error desconocido: ${error.message}`
                }
            }
        },

        sendData(content) {
            const id = {
                id: content,
                idUser: this.user
            };
            const apiUrl = `${this.route}api/stand_assistances`;
            axios.post(apiUrl, id)
                .then(response => {
                    console.log("Asistencia registrada: ", response.data);
                    //alert(response.data);
                })
                .catch(error => {
                    if (error.response) {
                        // El servidor respondió con un código de estado fuera del rango 2xx
                        console.log("Error del servidor:", error.response.status);
                        console.log("Mensaje de error:", error.response.data);
                        this.error = error.response.data.message;
                    } else if (error.request) {
                        // La petición fue hecha pero no se recibió respuesta
                        console.log("No se recibió respuesta del servidor");
                    } else {
                        // Algo ocurrió al configurar la petición que provocó un error
                        console.log("Error de configuración:", error.message);
                    }
                });
        }
    }
}
</script>

<style scoped>
.error-message {
    color: red;
    background-color: #ffeeee;
    border: 1px solid red;
    padding: 10px;
    margin-top: 10px;
    border-radius: 4px;
}

.success-message {
    color: rgb(115, 189, 4);
    background-color: rgb(234, 255, 202);
    border: 1px solid rgb(115, 189, 4);
    padding: 10px;
    margin-top: 10px;
    border-radius: 4px;
}

.scan {
    border: double 2px transparent;
    border-radius: 5px;
    background-image: linear-gradient(white, white),
        radial-gradient(circle at top left, lightgreen, #14ABE3);
    background-origin: border-box;
    background-clip: content-box, border-box;
    width: 100%;
    height: auto;
}
</style>