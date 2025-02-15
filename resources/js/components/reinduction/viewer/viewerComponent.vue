<template>
    <v-app>
        <v-container fluid>
            <h1>Mis asistencias a stands</h1>
            <div class="mb-4">
                <div class="row">
                    <div class="col-6">
                        <div class="d-flex justify-center align-center fill-height">
                            <v-btn @click="fetchUserPresentations" color="primary">
                                <v-icon style="font-size: 150%;" color="white">
                                    mdi-sync
                                </v-icon><span>Actualizar</span></v-btn>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="text-h6 mr-4"><strong>Progreso:</strong></div>
                            <div class="text-subtitle-1">{{ completedCount }} de {{ totalAreas }} stands</div>
                        </div>
                    </div>
                </div>
                <v-progress-linear :value="progressPercentage" height="25" :buffer-value="progressPercentage" stream
                    striped color="#d9ad26">
                    <template v-slot:default="{ value }">
                        <strong>{{ Math.ceil(progressPercentage) }}%</strong>
                    </template>
                </v-progress-linear>
            </div>

            <v-card>
                <v-row>
                    <v-col v-for="area in areas" :key="area" cols="6" sm="6" md="4" lg="3" class="pa-1 d-flex align-center justify-center">
                        <div>
                            <v-img :src="getPresentationImage(area)" :width="150">
                                <template v-slot:placeholder>
                                    <v-row class="fill-height ma-0" align="center" justify="center">
                                        <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                                    </v-row>
                                </template>
                            </v-img>
                            <!-- <v-card-title>{{ getAreaName(area) }}</v-card-title> -->
                            <!-- <v-card-subtitle>
                                    Estado: {{ getStatusText(area) }}
                                </v-card-subtitle> -->
                            <div class="text-center">
                                <v-card-text class="pa-0"
                                    v-if="getPresentationData(area) && getPresentationData(area).approved_date">
                                    Fecha aprobación: <br>{{ formatDate(getPresentationData(area).approved_date) }}
                                </v-card-text>
                            </div>        
                        </div>
                    </v-col>
                </v-row>
            </v-card>
        </v-container>
    </v-app>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        user: Number,
        route: String
    },
    data() {
        return {
            userPresentations: null,
            dataLoaded: false,
            areas: [
                "biomedico",
                "calidad",
                "comunicaciones",
                "control_infecciones",
                "coorgeneral_enfer",
                "farmacia",
                "gestion_ambiental",
                "gestion_riesgo_sarlaft",
                "humanizacion",
                "mantenimiento",
                "seg_paciente",
                "siau",
                "sistemas",
                "sst_th",
                "vigilancia_epidemiologica"
            ],
            imageMap: {
                biomedico: {
                    default: `${this.route}images/Capacitacion/BIOMEDICO/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/BIOMEDICO/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/BIOMEDICO/Aprobado.png`
                },
                calidad: {
                    default: `${this.route}images/Capacitacion/CALIDAD/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/CALIDAD/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/CALIDAD/Aprobado.png`
                },
                comunicaciones: {
                    default: `${this.route}images/Capacitacion/COMUNICACIONES/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/COMUNICACIONES/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/COMUNICACIONES/Aprobado.png`
                },
                control_infecciones: {
                    default: `${this.route}images/Capacitacion/CONTROL_INFECCIONES/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/CONTROL_INFECCIONES/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/CONTROL_INFECCIONES/Aprobado.png`
                },
                coorgeneral_enfer: {
                    default: `${this.route}images/Capacitacion/COORGENERAL_ENFER/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/COORGENERAL_ENFER/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/COORGENERAL_ENFER/Aprobado.png`
                },
                farmacia: {
                    default: `${this.route}images/Capacitacion/FARMACIA/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/FARMACIA/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/FARMACIA/Aprobado.png`
                },
                gestion_ambiental: {
                    default: `${this.route}images/Capacitacion/GESTION_AMBIENTAL/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/GESTION_AMBIENTAL/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/GESTION_AMBIENTAL/Aprobado.png`
                },
                gestion_riesgo_sarlaft: {
                    default: `${this.route}images/Capacitacion/GESTION_RIESGO_SARLAFT/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/GESTION_RIESGO_SARLAFT/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/GESTION_RIESGO_SARLAFT/Aprobado.png`
                },
                humanizacion: {
                    default: `${this.route}images/Capacitacion/HUMANIZACION/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/HUMANIZACION/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/HUMANIZACION/Aprobado.png`
                },
                mantenimiento: {
                    default: `${this.route}images/Capacitacion/MANTENIMIENTO/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/MANTENIMIENTO/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/MANTENIMIENTO/Aprobado.png`
                },
                seg_paciente: {
                    default: `${this.route}images/Capacitacion/SEG_PACIENTE/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/SEG_PACIENTE/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/SEG_PACIENTE/Aprobado.png`
                },
                siau: {
                    default: `${this.route}images/Capacitacion/SIAU/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/SIAU/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/SIAU/Aprobado.png`
                },
                sistemas: {
                    default: `${this.route}images/Capacitacion/SISTEMAS/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/SISTEMAS/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/SISTEMAS/Aprobado.png`
                },
                sst_th: {
                    default: `${this.route}images/Capacitacion/SST_TH/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/SST_TH/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/SST_TH/Aprobado.png`
                },
                vigilancia_epidemiologica: {
                    default: `${this.route}images/Capacitacion/VIGILANCIA_EPIMEDIOLOGICA/SIN_ASISTIR.png`,
                    registered: `${this.route}images/Capacitacion/VIGILANCIA_EPIMEDIOLOGICA/PROCESO.png`,
                    approved: `${this.route}images/Capacitacion/VIGILANCIA_EPIMEDIOLOGICA/Aprobado.png`
                },
            }
        }
    },
    computed: {
        completedCount() {
            if (!this.userPresentations) return 0;
            return this.userPresentations.filter(presentation =>
                presentation && presentation.approved_date
            ).length;
        },
        totalAreas() {
            return this.areas.length;
        },
        progressPercentage() {
            return (this.completedCount / this.totalAreas) * 100;
        }
    },
    methods: {
        getPresentationImage(area) {
            const presentation = this.getPresentationData(area);
            if (!presentation) {
                return this.imageMap[area].default;
            }
            if (presentation.approved_date) {
                return this.imageMap[area].approved;
            }
            return this.imageMap[area].registered;
        },
        getAreaName(area) {
            const areaNames = {
                biomedico: 'Biomedico',
                calidad: "Calidad",
                comunicaciones: "Comunicaciones",
                farmacia: "Farmacia",
                gestion_ambiental: "Gestión ambiental",
                gestion_riesgo_sarlaft: "Gestión de riesgo SARLAFT",
                humanizacion: "Humanización",
                mantenimiento: 'Mantenimiento',
                seg_paciente_coorgeneral_enfer: "Seguridad del paciente y coordinacion general de enfermeria",
                siau: "SIAU",
                sistemas: 'Sistemas',
                sst_th: "Seguridad y salud en el trabajo y Talento humano",
                vigilancia_epidemiologica: "Vigilancia epimediologica y control de infecciones"
            };
            return areaNames[area] || area;
        },
        getStatusText(area) {
            const presentation = this.getPresentationData(area);
            if (!presentation) {
                return 'Sin asistir';
            }
            return presentation.state;
        },
        formatDate(dateString) {
            return new Date(dateString).toLocaleDateString();
        },
        getPresentationData(area) {
            if (!this.userPresentations || !Array.isArray(this.userPresentations)) {
                return null;
            }
            //this.userPresentations.stand.toLowerCase() === area ? this.userPresentations : null
            //console.log(area);
            return this.userPresentations.find(p => p && p.stand && p.stand.toLowerCase() === area.toLowerCase());
        },
        async fetchUserPresentations() {
            try {
                const apiUrl = `${this.route}api/viewer/${this.user}`;
                const response = await axios.get(apiUrl);

                if (response.data.success) {
                    this.userPresentations = response.data.data;
                } else {
                    console.warn("Error:", response.data.message);
                    this.userPresentations = [];
                }

                this.dataLoaded = true;
                this.$forceUpdate();
                //console.log(this.userPresentations); // Verifica los datos obtenidos
            } catch (error) {
                console.error('Error fetching user presentations:', error);
                this.dataLoaded = true;
            }
        }
    },
    mounted() {
        this.fetchUserPresentations();
    }
}
</script>
<style scoped lang="scss">
::v-deep .v-application--wrap {
    min-height: fit-content;
}
</style>
<style>
.scroll {
    scrollbar-width: none;
}
</style>