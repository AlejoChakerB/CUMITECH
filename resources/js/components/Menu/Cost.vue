<template>
    <v-app>
        <v-container v-if="this.view_procedure || this.view_articles || this.view_generalcosts">
            <v-row>
                <v-col cols="12" sm="6" md="4">
                    <div class="d-flex align-start">
                        <h3>GENERAL</h3>
                        <v-avatar tile size="30" color="#55D46B" class="rounded-lg ml-2">
                            <span style="color: white;">
                                <strong>3</strong>
                            </span>
                        </v-avatar>
                    </div>
                </v-col>
            </v-row>
            <v-divider class="mt-0"></v-divider>
            <v-row>
                <v-col cols="12" sm="6" md="4" v-if="this.view_procedure">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('procedure')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="#55D46B" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-file-document-outline
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Procedimientos
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y gestión de los diferentes procedimientos médicos</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_articles">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('article')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="#55D46B" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-shopping-outline
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Articulos médicos
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y gestión de los diferentes articulos médicos</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_generalcosts">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('general')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="#55D46B" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-currency-usd
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costo general
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y gestion de los costos generales de los diferentes servicios</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
        </v-container>
        <v-container v-if="this.view_diferentialrates || this.view_doctors || this.view_medicalfees || this.view_soat">
            <v-row>
                <v-col cols="12" sm="6" md="4">
                    <div class="d-flex align-start">
                        <h3>CUENTAS MÉDICAS</h3>
                        <v-avatar tile size="30" color="#27BFD6" class="rounded-lg ml-2">
                            <span style="color: white;">
                                <strong>4</strong>
                            </span>
                        </v-avatar>
                    </div>
                </v-col>
            </v-row>
            <v-divider class="mt-0"></v-divider>
            <v-row>
                <v-col cols="12" sm="6" md="4" v-if="this.view_diferentialrates">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('rates')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="#27BFD6" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-file-document-multiple-outline
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Tarifas <br> diferenciales
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y configuracion de las tarifas diferenciales de los médicos</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_doctors">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('doctor')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="#27BFD6" class="rounded-xl">
                                    <v-icon style="font-size: 160%;" color="white">
                                        mdi-doctor
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Contratacion <br>médicos
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y configuracion de las contrataciones de los médicos</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_medicalfees">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('fees')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="#27BFD6" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-stethoscope
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Manuales <br> de pago
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y gestión de los diferentes tipos de manuales de pago</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_soat">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('soat')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="#27BFD6" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-file-document-outline
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Grupos SOAT
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y gestión de los grupos SOAT</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
        </v-container>
        <v-container v-if="this.view_unitcosts || this.view_logoperationcosts || this.view_surgeries || this.view_baskets || this.view_distpackages || this.view_consumables || this.view_rentedequipments">
            <v-row>
                <v-col cols="12" sm="6" md="4">
                    <div class="d-flex align-start">
                        <h3>CIRUGIA</h3>
                        <v-avatar tile size="30" color="red darken-2" class="rounded-lg ml-2">
                            <span style="color: white;">
                                <strong>8</strong>
                            </span>
                        </v-avatar>
                    </div>
                </v-col>
            </v-row>
            <v-divider class="mt-0"></v-divider>
            <v-row>
                <v-col cols="12" sm="6" md="4" v-if="this.view_unitcosts">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('unit')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="red darken-2" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-account-cash
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costos unitarios
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y calculo de costos en el area de cirugia</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_logoperationcosts">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('logOperation')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="red darken-2" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-account-cash
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Detalles<br> costo unitario
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Detalles del costo unitario</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_surgeries">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('surgery')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="red darken-2" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-hospital-box-outline
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Cirugias realizadas
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Obtencion de las cirugias realizadas</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_surgeries">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('mprocedures')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="red darken-2" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-hospital-box-outline
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Procedimientos<br>realizados
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Procedimientos de las cirugias</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_baskets">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('basket')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="red darken-2" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-basket-fill
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Canasta
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Canastas de las cirugias</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_distpackages">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('distpack')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="red darken-2" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-package
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Paquetes
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Costo de la inclusion del paquete</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_consumables">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('consumable')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="red darken-2" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-basket-fill
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Consumibles
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Consumibles de las cirugias</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_rentedequipments">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('rented')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="red darken-2" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-basket-fill
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Equipos alquilados
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y gestión de equipos alquilados</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
        </v-container>
        <v-container v-if="this.view_imagingproductiondetails || this.view_imagingproductionmonths || this.view_imagingproductionhourcosts || this.view_imagingproductionsupplies">
            <v-row>
                <v-col cols="12" sm="6" md="6">
                    <div class="d-flex align-start">
                        <h3>IMAGENES DIAGNOSTICAS</h3>
                        <v-avatar tile size="30" color="blue darken-3" class="rounded-lg ml-2">
                            <span style="color: white;">
                                <strong>4</strong>
                            </span>
                        </v-avatar>
                    </div>
                </v-col>
            </v-row>
            <v-divider class="mt-0"></v-divider>
            <v-row>
                <v-col cols="12" sm="6" md="4" v-if="this.view_imagingproductiondetails">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('imdetail')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="blue darken-3" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-account-cash
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costos unitarios
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y calculo de costos en el area de imagenes diagnosticas</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_imagingproductionmonths">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('immonth')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="blue darken-3" class="rounded-xl">
                                    <v-icon style="font-size: 200%;" color="white">
                                        mdi-radiology-box-outline
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Produccion mes
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Conteo de la producción mensual en el area de imagenes diagnosticas</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_imagingproductionhourcosts">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('imhour')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="blue darken-3" class="rounded-xl">
                                    <v-icon style="font-size: 200%;" color="white">
                                        mdi-timer-sand
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costo sala
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Valor por hora de las salas de los diferentes servicios de imagenologia</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_imagingproductionsupplies">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('imsuplies')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="blue darken-3" class="rounded-xl">
                                    <v-icon style="font-size: 200%;" color="white">
                                        mdi-medical-bag
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costos insumos
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Insumos utilizados para los diferentes servicios de imagenologia</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
        </v-container>
        <v-container v-if="this.view_cextdetails || this.view_cextproductionmonths || this.view_cexthourcosts">
            <v-row>
                <v-col cols="12" sm="6" md="4">
                    <div class="d-flex align-start">
                        <h3>CONSULTA EXTERNA</h3>
                        <v-avatar tile size="30" color="pink lighten-1" class="rounded-lg ml-2">
                            <span style="color: white;">
                                <strong>3</strong>
                            </span>
                        </v-avatar>
                    </div>
                </v-col>
            </v-row>
            <v-divider class="mt-0"></v-divider>
            <v-row>
                <v-col cols="12" sm="6" md="4" v-if="this.view_cextdetails">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('cextdetail')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="pink lighten-1" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-account-cash
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costos unitarios
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y calculo de costos en el area de consulta externa</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_cextproductionmonths">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('cextmonth')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="pink lighten-1" class="rounded-xl">
                                    <v-icon style="font-size: 200%;" color="white">
                                        mdi-doctor
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Produccion mes
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Conteo de la produccion mensual en el area de consulta externa</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_cexthourcosts">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('cexthour')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="pink lighten-1" class="rounded-xl">
                                    <v-icon style="font-size: 200%;" color="white">
                                        mdi-timer-sand
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costo sala
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Valor por hora de las salas de los servicios de consulta externa</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
        </v-container>
        <v-container v-if="this.view_accommodationcosts">
            <v-row>
                <v-col cols="12" sm="6" md="6">
                    <div class="d-flex align-start">
                        <h3>ESTANCIAS</h3>
                        <v-avatar tile size="30" color="teal" class="rounded-lg ml-2">
                            <span style="color: white;">
                                <strong>1</strong>
                            </span>
                        </v-avatar>
                    </div>
                </v-col>
            </v-row>
            <v-divider class="mt-0"></v-divider>
            <v-row>
                <v-col cols="12" sm="6" md="4" v-if="this.view_accommodationcosts">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('accomodation')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="teal" class="rounded-xl">
                                    <v-icon style="font-size: 200%;" color="white">
                                        mdi-bed
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costos unitarios
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y calculo de costos de las estancias ofrecidas en los servicios</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
        </v-container>
        <v-container v-if="this.view_cumilabrates || this.view_patologies || this.view_ambulancecosts || this.view_bloodbankmonths">
            <v-row>
                <v-col cols="12" sm="6" md="6">
                    <div class="d-flex align-start">
                        <h3>SERVICIOS TERCERIZADOS</h3>
                        <v-avatar tile size="30" color="deep-purple darken-2" class="rounded-lg ml-2">
                            <span style="color: white;">
                                <strong>4</strong>
                            </span>
                        </v-avatar>
                    </div>
                </v-col>
            </v-row>
            <v-divider class="mt-0"></v-divider>
            <v-row>
                <v-col cols="12" sm="6" md="4" v-if="this.view_cumilabrates">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('lab')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="deep-purple darken-2" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-flask-outline
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costos laboratorio
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y calculo de los costos del servicio de laboratorio CumiLab</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_patologies">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('patology')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="deep-purple darken-2" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-bacteria
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costos patologia
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y calculo de los costos del servicio de patologia</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_bloodbankmonths">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('blood')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="#da1b1b" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-blood-bag
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costos banco sangre
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y calculo de los costos del servicio de banco de sangre</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="4" v-if="this.view_ambulancecosts">
                    <v-hover v-slot="{ hover }">
                        <v-card class="mx-auto" max-width="500" outlined @click="handleCardClick('ambulance')"
                            :elevation="hover ? 16 : 2" :class="{ 'on-hover': hover }">
                            <v-list-item three-line>
                                <v-list-item-avatar tile size="50" color="#da1b1b" class="rounded-xl">
                                    <v-icon style="font-size: 150%;" color="white">
                                        mdi-ambulance
                                    </v-icon>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 mb-1">
                                        Costos ambulancia
                                    </v-list-item-title>
                                    <v-list-item-subtitle>Registro y calculo de los costos del servicio de ambulancia</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props: {
        labourRoute: String,
        proceduresRoute: String,
        articlesRoute: String,
        basketRoute: String,
        consumableRoute: String,
        rateRoute: String,
        feesRoute: String,
        doctorsRoute: String,
        surgeriesRoute: String,
        unitRoute: String,
        generalRoute: String,
        soatRoute: String,
        msurgeryRoute: String,
        logRoute: String,
        rentedRoute: String,
        labRoute: String,
        imagingdetailRoute: String,
        imaginghourRoute: String,
        imagingmonthRoute: String,
        imagingsupliesRoute: String,
        cextdetailRoute: String,
        cexthourRoute: String,
        cextmonthRoute: String,
        accomodationRoute: String,
        bloodRoute: String,
        ambulanceRoute: String,
        patologiRoute: String,
        distpackRoute: String,

        view_procedure: Boolean,
        view_articles: Boolean,
        view_generalcosts: Boolean,
        view_diferentialrates: Boolean,
        view_doctors: Boolean,
        view_medicalfees: Boolean,
        view_soat: Boolean,
        view_unitcosts: Boolean,
        view_logoperationcosts: Boolean,
        view_surgeries: Boolean,
        view_baskets: Boolean,
        view_distpackages: Boolean,
        view_consumables: Boolean,
        view_rentedequipments: Boolean,
        view_imagingproductiondetails: Boolean,
        view_imagingproductionmonths: Boolean,
        view_imagingproductionhourcosts: Boolean,
        view_imagingproductionsupplies: Boolean,
        view_cextdetails: Boolean,
        view_cextproductionmonths: Boolean,
        view_cexthourcosts: Boolean,
        view_accommodationcosts: Boolean,
        view_cumilabrates: Boolean,
        view_patologies: Boolean,
        view_ambulancecosts: Boolean,
        view_bloodbankmonths: Boolean
    },
    methods: {
        handleCardClick(route) {
            if (route === 'labour') {
                window.location.href = this.labourRoute;
            } else if (route === 'procedure') {
                window.location.href = this.proceduresRoute;
            } else if (route === 'rates') {
                window.location.href = this.rateRoute;
            } else if (route === 'fees') {
                window.location.href = this.feesRoute;
            } else if (route === 'doctor') {
                window.location.href = this.doctorsRoute;
            } else if (route === 'article') {
                window.location.href = this.articlesRoute;
            } else if (route === 'basket') {
                window.location.href = this.basketRoute;
            } else if (route === 'consumable') {
                window.location.href = this.consumableRoute;
            } else if (route === 'surgery') {
                window.location.href = this.surgeriesRoute;
            } else if (route === 'unit') {
                window.location.href = this.unitRoute;
            } else if (route === 'general') {
                window.location.href = this.generalRoute;
            } else if (route === 'soat') {
                window.location.href = this.soatRoute;
            } else if (route === 'mprocedures') {
                window.location.href = this.msurgeryRoute;
            } else if (route === 'logOperation') {
                window.location.href = this.logRoute;
            } else if (route === 'rented') {
                window.location.href = this.rentedRoute;
            } else if (route === 'lab') {
                window.location.href = this.labRoute;
            }else if (route === 'imdetail') {
                window.location.href = this.imagingdetailRoute
            }else if (route === 'imhour') {
                window.location.href = this.imaginghourRoute
            }else if (route === 'immonth') {
                window.location.href = this.imagingmonthRoute
            }else if (route === 'imsuplies') {
                window.location.href = this.imagingsupliesRoute
            }else if (route === 'cextdetail') {
                window.location.href = this.cextdetailRoute
            }else if (route === 'cextmonth') {
                window.location.href = this.cextmonthRoute
            }else if (route === 'cexthour') {
                window.location.href = this.cexthourRoute
            }else if (route === 'accomodation') {
                window.location.href = this.accomodationRoute
            }else if (route === 'blood') {
                window.location.href = this.bloodRoute
            }else if (route === 'ambulance') {
                window.location.href = this.ambulanceRoute
            }else if (route === 'patology') {
                window.location.href = this.patologiRoute
            }else if (route === 'distpack') {
                window.location.href = this.distpackRoute
            }
        }
    }
};
</script>
<style scoped lang="scss">
::v-deep .v-application--wrap {
    min-height: fit-content;
}

::v-deep .v-dialog {
    box-shadow: none;
}
</style>

<style>
.v-divider {
    color: #22a708;
}

h3 {
    color: black;
}
</style>
