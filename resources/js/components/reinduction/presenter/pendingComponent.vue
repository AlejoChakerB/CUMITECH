<template>
    <v-app>
        <v-card max-width="800">
            <div class="row">
                <div class="col-4 center">
                    <v-img :src="'data:image/png;base64,' + infoPresenters.qr_code" max-width="270" contain
                        class="image"></v-img>
                </div>
                <div class="col-8">
                    <v-card-title>
                        <div class="text-h6" color="primary">
                            {{ infoPresenters.name }}
                        </div>
                    </v-card-title>
                    <v-card-subtitle>
                        <div class="text-primary">{{ infoPresenters.work_position }}</div>
                    </v-card-subtitle>
                    <v-card-text>
                        <div>Reinducciones CUMI</div>
                        <div>Stand: {{ infoPresenters.stand }} </div>
                    </v-card-text>
                    <div class="pl-3">
                        <v-divider></v-divider>
                    </div>
                    <v-card-actions>
                        <v-row class="text-center">
                            <v-col cols="6">
                                <div class="stat-item">
                                    <div class="text-body-2 text-grey">Pendientes</div>
                                    <div class="text-h5 text-blue">{{ quantyPending }}</div>
                                </div>
                            </v-col>
                            <v-col cols="6">
                                <div class="stat-item">
                                    <div class="text-body-2 text-grey">Aprobados</div>
                                    <div class="text-h5 text-blue">{{ quantyApproved }}</div>
                                </div>
                            </v-col>
                        </v-row>
                    </v-card-actions>
                </div>
            </div>
        </v-card>
        <v-card class="mt-5">
            <v-container fluid>
                <v-btn @click="sendSelectedData" color="success">
                    <v-icon style="font-size: 150%;" color="white">
                        mdi-check-decagram-outline
                    </v-icon><span>Aprobar</span></v-btn>
                <v-btn @click="getPresenter" color="primary">
                    <v-icon style="font-size: 150%;" color="white">
                        mdi-sync
                    </v-icon><span>Actualizar</span></v-btn>
                <v-btn @click="getPresenter" color="teal">
                    <v-icon style="font-size: 150%;" color="white">
                        mdi-history
                    </v-icon><span class="text-white">Aprobados</span></v-btn>
                <v-simple-table>
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th class="text-left">
                                    <v-checkbox v-model="selectAll" @click="toggleSelectAll" color="success"
                                        :indeterminate="indeterminate"></v-checkbox>
                                </th>
                                <th class="text-left">
                                    DNI
                                </th>
                                <th class="text-left">
                                    Nombre
                                </th>
                                <th class="text-left">
                                    Cargo
                                </th>
                                <th class="text-left">
                                    Centro costos
                                </th>
                                <th class="text-left">
                                    Fecha registro
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="presenter in presenters" :key="presenter.id">
                                <td><v-checkbox v-model="selected" :value="presenter.id" color="success"></v-checkbox>
                                </td>
                                <td>{{ presenter.dni }}</td>
                                <td>{{ presenter.name }}</td>
                                <td>{{ presenter.work_position }}</td>
                                <td>{{ presenter.cost_center }}</td>
                                <td>{{ formatDate(presenter.created_at) }}</td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
                <p>Total seleccionados: {{ selected.length }}</p>
            </v-container>
        </v-card>
    </v-app>
</template>
<script>
export default {
    props: {
        user: Number,
        route: String
    },
    data() {
        return {
            selected: [],
            presenters: [],
            approved: [],
            infoPresenters: [],
            quantyPending: 0,
            quantyApproved: 0,
            selectAll: null,
            indeterminate: true,
        }
    },
    methods: {
        toggleSelectAll() {
            if (this.selectAll) {
                // Seleccionar todos
                this.selected = this.presenters.map(presenter => presenter.id);
            } else {
                // Deseleccionar todos
                this.selected = [];
            }
        },
        getPresenter() {
            const apiUrl = `${this.route}api/showPending/${this.user}`;
            axios.get(apiUrl)
                .then(response => {
                    this.presenters = response.data.data;
                    this.quantyPending = this.presenters.length;
                })
                .catch(error => {
                    console.error("Error al obtener asistencias", error);
                });
        },
        getApproved() {
            const apiUrl = `${this.route}api/showApproved/${this.user}`;
            axios.get(apiUrl)
                .then(response => {
                    this.approved = response.data.data;
                    this.quantyApproved = this.approved.length;
                })
                .catch(error => {
                    console.error("Error al obtener asistencias", error);
                });
        },
        getInfoPresenter() {
            const apiUrl = `${this.route}api/showPresenter/${this.user}`;
            axios.get(apiUrl)
                .then(response => {
                    this.infoPresenters = response.data.data;
                })
                .catch(error => {
                    console.error("Error al obtener asistencias", error);
                });
        },
        sendSelectedData() {
            const apiUrl = `${this.route}api/approveAttendance`;
            axios.post(apiUrl, {
                selectedIds: this.selected
            })
                .then(response => {
                    this.getPresenter();
                    this.getApproved();
                    this.selected = [];
                    this.sweetAlertaSuccess();
                    
                })
                .catch(error => {
                    console.error("Error al enviar datos", error);
                    this.sweetAlertaError();
                });
        },
        formatDate(date) {
            const d = new Date(date)
            const dia = d.getDate().toString().padStart(2, '0')
            const mes = (d.getMonth() + 1).toString().padStart(2, '0')
            const año = d.getFullYear()

            let hora = d.getHours()
            const ampm = hora >= 12 ? 'PM' : 'AM'
            hora = hora % 12
            hora = hora ? hora : 12
            hora = hora.toString().padStart(2, '0')
            const minutos = d.getMinutes().toString().padStart(2, '0')

            return `${dia}/${mes}/${año} - ${hora}:${minutos} ${ampm}`
        },
        updateSelectAllState() {
            const totalItems = this.presenters.length;
            const selectedItems = this.selected.length;

            this.selectAll = selectedItems === totalItems;
            this.indeterminate = selectedItems > 0 && selectedItems < totalItems;
        },
        sweetAlertaSuccess() {
            Swal.fire({
                title: '¡Éxito!',
                text: '¡¡Espectadores aprobados correctamente!!',
                icon: 'success',
                confirmButtonText: 'Genial',
                timer: 1200
            })
        },

        sweetAlertaError() {
            Swal.fire({
                title: '¡Error!',
                text: '¡¡Error al enviar datos!!',
                icon: 'error',
                confirmButtonText: 'Ok',
                timer: 1200
            })
        },
    },
    watch: {
        selected() {
            this.updateSelectAllState();
        }
    },
    mounted() {
        this.getPresenter();
        this.getApproved();
        this.getInfoPresenter();
    }
}
</script>

<style scoped lang="scss">
::v-deep .v-application--wrap {
    min-height: fit-content;
}
</style>

<style>
.center {
    align-content: center;
    display: block;
}

.image {
    margin: 0 auto;
}
</style>