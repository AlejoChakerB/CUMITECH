<template>
    <v-app>
        <v-row justify="center">
            <v-dialog v-model="dialog" max-width="650px" scrollable>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn icon color="#13A4DA" v-bind="attrs" v-on="on">
                        <v-icon>mdi-eye-outline</v-icon>
                    </v-btn>
                </template>
                <v-card class="mt-8">
                    <v-card-title>
                        <span class="text-h6">Acta #{{ medicine.act_number }} - Fecha: {{
                            medicine.admission_date.substring(0, 10) }}</span>
                    </v-card-title>
                    <v-card-text>
                        <v-divider></v-divider>
                        <v-container>
                            <v-row>
                                <v-col cols="4">
                                    <span><strong>Detalles invima</strong></span>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Nombre generico:</label>
                                    <v-text-field v-model="medicine.generic_name" readonly></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Nombre comercial:</label>
                                    <v-text-field v-model="medicine.tradename" readonly></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4">
                                    <span></span>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Forma farmaceutica:</label>
                                    <v-text-field v-model="medicine.pharmaceutical_form" readonly></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Laboratorio fabricante</label>
                                    <v-text-field v-model="medicine.manufacturer_laboratory" readonly></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4">
                                    <span></span>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Registro invima:</label>
                                    <v-text-field v-model="invima" readonly></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Vigencia de registro:</label>
                                    <v-text-field v-model="registration_validity" readonly></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                        <v-divider></v-divider>
                        <v-container>
                            <v-row>
                                <v-col cols="4">
                                    <span><strong>Factura</strong></span>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0"># Factura:</label>
                                    <v-text-field v-model="medicine.invoice_number" readonly></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Proveedor:</label>
                                    <v-text-field v-model="medicine.supplier" readonly></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4">
                                    <span></span>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Cantidad recibida:</label>
                                    <v-text-field v-model="medicine.received_amount" readonly></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Muestras recibidas:</label>
                                    <v-text-field v-model="medicine.sample" readonly></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                        <v-divider></v-divider>
                        <v-container>
                            <v-row>
                                <v-col cols="4">
                                    <span><strong>Detalle medicamento</strong></span>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Presentacion:</label>
                                    <v-text-field v-model="medicine.presentation" readonly></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Concentracion:</label>
                                    <v-text-field v-model="medicine.concentration" readonly></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4">
                                    <span></span>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Número de lote:</label>
                                    <v-text-field v-model="medicine.lot_number" readonly></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Fecha de vencimiento:</label>
                                    <v-text-field v-model="expiration_date" readonly></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4">
                                    <span></span>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Temperatura(°C):</label>
                                    <v-text-field class="red--text" v-model="medicine.arrival_temperature" readonly></v-text-field>
                                </v-col>
                            </v-row>
                            <v-divider></v-divider>
                            <v-row>
                                <v-col cols="4">
                                    <span><strong>Calificacion:</strong></span>
                                </v-col>
                                <v-col cols="8">
                                    <v-row>
                                        <v-col v-for="(value, key) in filteredData" :key="key" cols="4">
                                            <label style="color: #69C5A0">{{ translateLabel(key) }}</label>
                                            <v-icon :style="getBackgroundColorStyle(value)">mdi-pill</v-icon>
                                            <v-text-field v-if="value !== null" :value="value" readonly></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-col>
                            </v-row>
                        </v-container>
                        <v-divider></v-divider>
                        <v-container>
                            <v-row>
                                <v-col cols="4">
                                    <span><strong>Detalles extra</strong></span>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Orden de compra:</label>
                                    <v-text-field v-model="medicine.purchase_order" readonly></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Observaciones:</label>
                                    <v-text-field v-model="medicine.observations" readonly></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4">
                                    <span><strong></strong></span>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Estado:</label>
                                    <v-text-field v-model="medicine.state" readonly></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <label for="details" style="color: #69C5A0">Usuario:</label>
                                    <v-text-field v-model="medicine.entered_by" readonly></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-chip v-if="chip2" class="ma-2" close color="blue" label outlined @click="dialog = false">
                            Cerrar
                        </v-chip>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </v-app>
</template>
<script>
export default {

    props: {
        medicine: {
            type: Object
        },
        invima: {
            type: String
        }
    },

    data: () => ({
        dialog: false,
        overlay: false,
        chip2: true,
        expiration_date: null,
        registration_validity: null,
    }),
    created() {
        this.expiration_date = this.medicine.expiration_date.substring(0, 10);
        this.registration_validity = this.medicine.registration_validity.substring(0, 10);
    },
    methods: {
        translateLabel(key) {
            const translationMap = {
                "lettering": "Rotulado",
                "packing": "Empaque",
                "laminate": "Laminado",
                "closing": "Cierre",
                "all": "Todo",
                "liquids": "Líquidos",
                "semisolid": "Semi-sólido",
                "dust": "Polvo",
                "tablet": "Tableta",
                "capsule": "Cápsula"
            };

            return translationMap[key] || key;
        },
        // Método para obtener el estilo de fondo según el valor
        getBackgroundColorStyle(value) {
            if (value === "Critico" || value === "Mayor") {
                return { color: "red" };
            } else if (value === "Optimo") {
                return { color: "green" };
            } else if (value === "Menor") {
                return { color: "yellow" };
            } else if (value === "NA") {
                return { color: "grey" };
            } else {
                return {}; // Estilo predeterminado
            }
        },


    },
    computed: {
        // Filtrar los datos para obtener solo los que no son nulos y están en la lista
        filteredData() {
            const allowedFields = ["lettering", "packing", "laminate", "closing", "all", "liquids", "semisolid", "dust", "tablet", "capsule"];
            const filtered = {};

            const data = this.medicine;
            for (const key of allowedFields) {
                const value = data[key];
                if (value !== null) {
                    filtered[key] = value;
                }
            }

            return filtered;
        }
    }
}
</script>
<style scoped lang="scss">
::v-deep .v-application--wrap {
    min-height: fit-content;
}

::v-deep .v-dialog {
    box-shadow: none;
}
</style>