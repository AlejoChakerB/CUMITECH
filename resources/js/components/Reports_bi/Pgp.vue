<template>
  <v-container fluid>
    <v-row>
      <h6 class="tittle-color">Seguimiento a contrato</h6>
      <v-col cols="6" v-for="(column, index) in visibleColumns" :key="index">
        <v-list flat class="custom-list-item">
          <v-list-item v-for="(item, itemIndex) in column" :key="itemIndex"
            @mouseover="showDescription(item.description); hoverItem = item"
            @mouseleave="clearDescription(); hoverItem = null" :href="getServiceRoute(item.route)"
            :style="{ '--hover-color': item.color_icon }" v-if="item.permission">
            <v-list-item-icon>
              <v-icon :color="item.color_icon">{{ item.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title :style="getTitleStyle(item)">{{ item.title }}</v-list-item-title>
              <v-list-item-subtitle v-if="item.subtitle" :style="getSubtitleStyle(item)">{{ item.subtitle }}
              </v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="11">
        <v-divider class="divider"></v-divider>
        <h6><strong>Descripción</strong></h6>
        <div class="description-container">
          <v-fade-transition>
            <div v-if="selectedDescription" class="tittle-color">
              <span>{{ selectedDescription }}</span>
            </div>
          </v-fade-transition>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  props: {
    asset: {
      type: String
    },
    pgputriocumiprojection: Boolean,
    pgputriocumiplanning: Boolean,
    ponalcontractcardiovascular: Boolean,
    utponalhospitalemergencycontract: Boolean,
  },
  data() {
    return {
      items: [
        { title: 'Proyección PGP UT RÍO-CUMI', subtitle: 'Contrato 142', description: 'Detallado de proyección del contrato', icon: 'mdi-chart-line', color_icon: '#122EEA', route: 'pgp_ut_riocumi_projection', permission: this.pgputriocumiprojection },
        { title: 'Ordenamiento PGP UT RÍO-CUMI', subtitle: 'Contrato 142', description: 'Detallado de ordenamiento del contrato', icon: 'mdi-chart-bar', color_icon: '#122EEA', route: 'Pgp_ut_riocumi_planning', permission: this.pgputriocumiplanning },
        { title: 'Contrato PONAL', subtitle: 'Cardiovascular', description: 'Detallado del contrato PONAL - Cardiovascular', icon: 'mdi-text-box-outline', color_icon: '#122EEA', route: 'ponal_contract_cardiovascular', permission: this.ponalcontractcardiovascular },
        { title: 'Contrato UT PONAL hospitalario', subtitle: 'Urgencias', description: 'Detallado del contrato UT PONAL hospitalario - urgencias', icon: 'mdi-hospital', color_icon: '#122EEA', route: 'ut_ponal_hospital_emergency_contract', permission: this.utponalhospitalemergencycontract },
      ],
      selectedDescription: '',
      hoverItem: null,
    }
  },
  methods: {
    getServiceRoute(route) {
      const baseUrl = this.asset;
      const serviceRoute = `${route}`;
      return baseUrl + serviceRoute;
    },
    showDescription(description) {
      this.selectedDescription = description;
    },
    clearDescription() {
      this.selectedDescription = '';
    },
    getItemStyle(item) {
      return {
        '--hover-color': item.color_icon,
        cursor: 'pointer',
      }
    },
    getTitleStyle(item) {
      return {
        color: this.hoverItem === item ? item.color_icon : '',
        transition: 'color 0.3s ease',
      }
    },
    getSubtitleStyle(item) {
      return {
        color: this.hoverItem === item ? 'black' : '',
        transition: 'color 0.3s ease',
      }
    },
  },
  computed: {
    visibleItems() {
      return this.items.filter(item => item.permission === true);
    },
    visibleColumns() {
      const midpoint = Math.ceil(this.visibleItems.length / 2);
      console.log(midpoint);
      return [
        this.visibleItems.slice(0, midpoint),
        this.visibleItems.slice(midpoint)
      ];
    }
  }
}
</script>

<style scoped>
.v-list-item {
  padding: 8px 0;
}

.tittle-color {
  color: #616161;
}

.divider {
  color: black;
}

.description-container {
  bottom: 20px;
  width: 100%;
  max-width: 800px;
  min-height: 50px;
  /* Ajusta según tus necesidades */
  align-items: center;
  justify-content: center;
}

.custom-list-item .custom-title,
.custom-list-item .custom-subtitle {
  transition: color 0.3s ease;
}

.custom-list-item:hover .custom-title {
  color: var(--hover-color) !important;
}

.custom-list-item:hover .custom-subtitle {
  color: black !important;
}
</style>