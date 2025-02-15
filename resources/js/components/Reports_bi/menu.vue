<template>
    <v-app>
        <v-container>
            <v-row>
                <!-- Elementos fijos a la izquierda -->
                <v-col cols="3" class="position-relative component-left">
                    <H6 class="tittle-color">CATEGORIAS</H6>
                    <div v-for="(item, index) in items" :key="index" @click="selectSection(item, $event)"
                        class="menu-item mb-2" :class="{ 'selected-item': item.selected }" :ref="`item-${index}`" v-if="item.permission1 || item.permission2 || item.permission3 || item.permission4 || item.permission5 || item.permission6">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-avatar class="custom-avatar elevation-1">
                                    <v-icon :color="item.color_icon">{{ item.icon }}</v-icon>
                                </v-avatar>
                            </v-list-item-icon>
                            <v-list-item-content class="prueb">
                                <v-list-item-title>{{ item.title }}</v-list-item-title>
                                <v-list-item-subtitle>{{ item.subtitle }}</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </div>
                    <!-- Card flotante -->
                    <v-card class="floating-card" :style="floatingCardStyle"></v-card>
                </v-col>
                <!-- Contenido dinámico a la derecha -->
                <v-col cols="9">
                    <v-card>
                        <div class="component-right">
                            <component :asset="this.asset" 
                                :financialreport="financialreport"
                                :financialexecution="financialexecution"
                                :pgputriocumiprojection="pgputriocumiprojection"
                                :pgputriocumiplanning="pgputriocumiplanning" 
                                :occupation="occupation"
                                :imagingproduction="imagingproduction"
                                :cextproduction="cextproduction"
                                :surgeryproduction="surgeryproduction"
                                :urgencyproduction ="urgencyproduction"
                                :billingstatistic="billingstatistic"
                                :endoscopyproduction="endoscopyproduction"
                                :utriocumiproduction="utriocumiproduction"
                                :ponalcontractcardiovascular="ponalcontractcardiovascular"
                                :utponalhospitalemergencycontract="utponalhospitalemergencycontract"
                                :reportcost="reportcost"
                                :is="currentSectionComponent"></component>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
import Pgp from './Pgp.vue';
import Costs from './Costs.vue';
import Reports from './Reports.vue';
import Productions from './production.vue';

export default {
    props: {
        asset: {
            type: String
        },
        financialreport: Boolean,
        financialexecution: Boolean,
        pgputriocumiprojection: Boolean,
        pgputriocumiplanning: Boolean,
        occupation: Boolean,
        imagingproduction: Boolean,
        cextproduction: Boolean,
        surgeryproduction: Boolean,
        urgencyproduction: Boolean,
        billingstatistic: Boolean,
        endoscopyproduction: Boolean,
        utriocumiproduction: Boolean,
        reportcost: Boolean,
        ponalcontractcardiovascular: Boolean,
        utponalhospitalemergencycontract: Boolean
    },
    data() {
        return {
            items: [
                { title: 'Seguimiento a contrato', subtitle: 'Seguimiento PGP y contratos PONAL', icon: 'mdi-finance', color_icon: '#122EEA', component: 'Pgp', permission1: this.pgputriocumiprojection, permission2: this.pgputriocumiplanning, permission3: this.ponalcontractcardiovascular, permission4: this.utponalhospitalemergencycontract, selected: true },
                { title: 'Finanzas', subtitle: 'Informes de costos', icon: 'mdi-cash-multiple', color_icon: '#370090', component: 'Costs', permission1: this.financialreport, permission2: this.financialexecution, permission3: this.billingstatistic, permission4: this.reportcost, selected: false },
                { title: 'Producciones', subtitle: 'Informes de produccion', icon: 'mdi-chart-line', color_icon: '#BDBBBA', component: 'Productions', permission1: this.imagingproduction, permission2: this.cextproduction, permission3: this.surgeryproduction, permission4: this.urgencyproduction, permission5: this.billingstatistic, permission6: this.endoscopyproduction, permission6: this.utriocumiproduction, selected: false },
                { title: 'Reportes', subtitle: 'Informes varios', icon: 'mdi-chart-donut-variant', color_icon: '#046E73', component: 'Reports', permission1: this.occupation, selected: false },
            ],
            currentSectionComponent: 'Pgp',
            floatingCardStyle: {
                top: '0px',
                height: '0px',
            },
            ruta: 'ejemplo'
        };
    },
    components: {
        Pgp,
        Costs,
        Reports,
        Productions
    },
    methods: {
        selectSection(item) {
            this.items.forEach(i => i.selected = false);
            item.selected = true;
            this.currentSectionComponent = item.component;

            this.$nextTick(() => {
                const element = event.currentTarget;
                const offset = element.offsetTop;
                this.floatingCardStyle = {
                    top: `${offset}px`,
                    height: `${element.offsetHeight}px`,
                };
            });
        }
    },
    mounted() {
        this.$nextTick(() => {
            const firstItem = this.$refs['item-0'][0];
            this.floatingCardStyle = {
                top: `${firstItem.offsetTop}px`,
                height: `${firstItem.offsetHeight}px`,
            };
        });
    }
};
</script>

<style scoped>
.position-relative {
    position: relative;
}

.menu-item {
    position: relative;
    z-index: 2;
    background-color: transparent;
    transition: color 0.3s ease;
}

.selected-item {
    color: white;
}

.floating-card {
    position: absolute;
    left: 0;
    width: 100%;
    background-color: #FAFBFC;
    transition: all 0.3s ease;
    z-index: 1;
}

.custom-avatar {
    background-color: white;
    border: 1px solid #eae9f0;
}

.tittle-color {
    color: #616161;
}

.component-left {
    padding-top: 3%;
}

.component-right {
    padding-top: 3%;
    padding-left: 3%;
}

.prueb{
    cursor: pointer;
    user-select: none;
}
</style>