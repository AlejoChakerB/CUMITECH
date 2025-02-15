<template>
    <v-app>
        <div>
            <div class=" d-flex justify-content-between mb-5" style="background-color: transparent; padding: 0 0;">
                <h3 class="card-title m-0" style="font-size: 35px; color: #2B3D63;">Procedimientos de cirugias</h3>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                <div class="d-flex flex-wrap justify-content-start">
                    <div class="input-group flex-grow-1 mr-2">
                        <div class="d-flex mr-2">
                            <div class="input-group mr-2" style="max-width: 100px;">
                                <div class="input-group-prepend">
                                    <label class="input-group-text border-right-0 view pr-1"
                                        style="background-color: transparent;"><span><i
                                                class="fas fa-align-justify"></i></span></label>
                                </div>
                                <select class="custom-select border-left-0 input" onchange="this.form.submit()">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="input-group flex-grow-1 mr-2">
                                <div class="input-group-prepend">
                                    <button @click="fetchSurgeries()"
                                        class="btn btn-outline-default border-right-0 pr-1" type="submit"
                                        style="box-shadow: none; border-color: #CED4DA"><strong><span
                                                class="fas fa-search"></span></strong></button>
                                </div>
                                <input v-model="search" type="text" class="form-control border-left-0 input flex-grow-1"
                                    name="search" placeholder="Buscar acto quirurgico"
                                    style="outline: none; box-shadow: none">
                            </div>
                        </div>

                        <div v-if="this.create" class="ml-auto d-flex align-items-center gap-2">
                            <a :href="`${route}msurgeryProcedures/create`" class="btn btn-default" title="Agregar contracto"
                                style="background-color: #2B3D63; color: white; position: relative;" id="btnAdd">
                                <div id="contentAdd" class="btn-content"><i class="fas fa-plus"></i> Añadir</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-hover shadow mb-3 rounded">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>N Servicio</th>
                            <th style="text-align: center;">Cantidad procedimientos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="surgery in surgeries.data">
                            <tr :id="'headingOne' + surgery.cod_surgical_act">
                                <td>{{ surgery.date_surgery }}</td>
                                <td>{{ surgery.cod_surgical_act }}</td>
                                <td style="text-align: center;"><strong>{{ surgery.msurgery_procedure_count }}</strong>
                                </td>
                                <td>
                                    <button @click="toggleCollapse(surgery.cod_surgical_act)" class="btn btn-default"
                                        title="Ver detalles"
                                        style="background-color: #2B3D63; color: white; position: relative;"
                                        :aria-expanded="true" aria-controls="collapse">
                                        Ver detalles <v-icon
                                            :class="{ 'icon-rotated': collapsedSurgeries.includes(surgery.cod_surgical_act) }"
                                            style="font-size: 150%;" color="white">mdi-chevron-right</v-icon>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="p-0">
                                    <transition name="fade" mode="out-in">
                                        <div v-if="collapsedSurgeries.includes(surgery.cod_surgical_act)"
                                            :key="surgery.cod_surgical_act" :id="'collapse' + surgery.cod_surgical_act"">
                                            <div v-if="procedures[surgery.cod_surgical_act] &&
                                                procedures[surgery.cod_surgical_act].length > 0" class="card-body box">
                                            <div class="collapse-content">
                                                <table class="table table-bordered box">
                                                    <thead>
                                                        <tr>
                                                            <th>CUPS</th>
                                                            <th>Descripción</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="procedure in procedures[surgery.cod_surgical_act]"
                                                            :key="procedure.id">
                                                            <td>{{ procedure.cups }}</td>
                                                            <td>{{ procedure.description }} - {{ procedure.manual_type
                                                                }}</td>
                                                            <td>
                                                                <div class='btn-group'>
                                                                    <a :href="`${route}msurgeryProcedures/${procedure.id}`"
                                                                        class='btn btn-default btn-xs'>
                                                                        <i class="far fa-eye"
                                                                            style="color: #13A4DA"></i>
                                                                    </a>
                                                                    <div v-if="update">
                                                                        <a :href="`${route}msurgeryProcedures/${procedure.id}/edit`"
                                                                            class='btn btn-default btn-xs'>
                                                                            <i class="far fa-edit"
                                                                                style="color: #6c6d77"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
            </div>
            </transition>
            </td>
            </tr>
</template>
</tbody>
</table>
<div class="pagination">
    <v-pagination v-model="page" :length="surgeries.last_page" :total-visible="7" color="primary"></v-pagination>
</div>
</div>
</div>
</v-app>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        route: String,
        create: Boolean,
        update: Boolean
    },
    data() {
        return {
            surgeries: {
                data: [],
                current_page: 1,
                last_page: 1,
                prev_page_url: null,
                next_page_url: null
            },
            procedures: {},
            collapsedSurgeries: [],
            search: '',
            per_page: 10,
            page: parseInt(localStorage.getItem('currentPage')) || 1,
        };
    },
    watch: {
        page(newPage) {
            localStorage.setItem('currentPage', newPage);
            this.fetchSurgeries(newPage);
        }
    },
    mounted() {
        const savedPage = parseInt(localStorage.getItem('currentPage')) || 1;
        this.page = savedPage;
        this.fetchSurgeries(this.page);
    },
    methods: {
        fetchSurgeries(page = 1) {
            const url = `${this.route}api/msurgery_procedures?page=${page}&per_page=${this.per_page}&search=${this.search}`
            axios.get(url)
                .then(response => {
                    this.surgeries = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getPageUrl(page) {
            return `${this.route}api/msurgery_procedures?page=${page}&per_page=${this.per_page}&search=${this.search}`;
        },
        toggleCollapse(codSurgery) {
            if (this.collapsedSurgeries.includes(codSurgery)) {
                this.collapsedSurgeries = this.collapsedSurgeries.filter(id => id !== codSurgery);
            } else {
                this.collapsedSurgeries.push(codSurgery);
                if (!this.procedures[codSurgery]) {
                    this.fetchProcedures(codSurgery);
                }
            }
        },
        fetchProcedures(codSurgery) {
            axios.get(`${this.route}api/msurgery_procedures/${codSurgery}/procedures`)
                .then(response => {
                    this.$set(this.procedures, codSurgery, response.data);
                })
                .catch(error => {
                    console.error("There was an error fetching the procedures:", error);
                });
        }
    },
    computed: {
        pageNumbers() {
            const totalPages = this.surgeries.last_page;
            const currentPage = this.surgeries.current_page;
            const range = 2; // número de páginas a mostrar a cada lado de la página actual
            let startPage = Math.max(1, currentPage - range);
            let endPage = Math.min(totalPages, currentPage + range);

            // Ajustar si el rango es menor al rango especificado
            if (currentPage <= range) {
                endPage = Math.min(totalPages, 2 * range + 1);
            }
            if (currentPage + range >= totalPages) {
                startPage = Math.max(1, totalPages - 2 * range);
            }

            // Generar un array de números de página para mostrar
            let pages = [];
            for (let i = startPage; i <= endPage; i++) {
                pages.push(i);
            }
            return pages;
        }
    }

};
</script>

<style scoped lang="scss">
::v-deep .v-application--wrap {
    min-height: fit-content;
}

</style>

<style>
.collapse-content {
    padding: 10px;
    border-radius: 5px;
    width: 100%;
}

/* Añadir animaciones */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(-10px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}

.v-icon {
    transition: transform 0.5s ease;
}

.icon-rotated {
    transform: rotate(90deg);
}

.pagination {
    display: flex;
    justify-content: flex-end;
}

.v-application .v-pagination .v-pagination__item.primary {
    background-color: #2B3D63 !important;
    border-color: #2B3D63 !important;
    color: white !important;
}

.v-application .v-pagination .v-pagination__item {
    color: #2B3D63;
}
</style>
