<template>
    <v-container fluid>
      <v-row>
        <h6 class="tittle-color">INFORMES PRODUCCIONES</h6>
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
      financialreport: Boolean,
      financialexecution: Boolean,
      imagingproduction: Boolean,
        cextproduction: Boolean,
        surgeryproduction: Boolean,
        urgencyproduction: Boolean,
        billingstatistic: Boolean,
        endoscopyproduction: Boolean,
        utriocumiproduction: Boolean
    },
    data() {
      return {
        items: [
          { title: 'Imagenes', subtitle: 'Producción imagenes', description: 'Este tablero muestra información general sobre la producción del servicio de imágenes, destacando el comportamiento mensual, el promedio de procedimientos y la participación de cada especialidad. Permite visualizar tanto las tendencias de crecimiento o disminución, como los detalles por cada tipo de procedimiento a lo largo del tiempo.', icon: 'mdi-radiology-box-outline', color_icon: '#32A997', route: 'imagingProduction', permission: this.imagingproduction },
          { title: 'Consulta externa', subtitle: 'Producción cext', description: 'Este tablero muestra la producción del servicio de consulta externa, proporcionando un análisis de la actividad mensual, el promedio de procedimientos y la participación por especialidad. Permite visualizar las fluctuaciones en la producción por mes y ofrece un desglose detallado de la producción por especialista, facilitando la evaluación del rendimiento general y de cada especialidad a lo largo del tiempo.', icon: 'mdi-stethoscope', color_icon: '#F279A2', route: 'cextProduction', permission: this.cextproduction },
          { title: 'Cirugia', subtitle: 'Producción cirugia', description: 'Este tablero ofrece una visión completa de la producción quirúrgica. Presenta indicadores clave como el promedio mensual de cirugías y su variación anual, acompañados de un gráfico que muestra la tendencia mensual. Además, incluye una representación visual de la distribución de cirugías por sala y un detallado desglose de la actividad por especialidad y médico. Esta herramienta permite un análisis rápido y efectivo del rendimiento del servicio quirúrgico, facilitando la toma de decisiones y la planificación estratégica.', icon: 'mdi-doctor', color_icon: '#E8AB51', route: 'surgeryProduction', permission: this.surgeryproduction },
          { title: 'Endoscopia', subtitle: 'Producción cirugia endoscopia', description: '', icon: 'mdi-doctor', color_icon: '#FF0000', route: 'endoscopyProduction', permission: this.endoscopyproduction },
          { title: 'Urgencias', subtitle: 'Producción urgencia', description: 'Este tablero muestra la producción del servicio de urgencias, presentando estadísticas clave como el número de atenciones en triage, consultas médicas, y el porcentaje de triages que resultaron en consulta médica. También incluye un gráfico que detalla la producción mensual de triages y consultas y otra tabla que incluye los detalles de la producción por contratos.', icon: 'mdi-hospital-marker', color_icon: '#FF0000', route: 'urgencyProduction', permission: this.urgencyproduction },
          { title: 'Producción UT', subtitle: 'Producción PGP UT RIO-CUMI', description: '', icon: 'mdi-abacus', color_icon: '#2692FF', route: 'utriocumiProduction', permission: this.utriocumiproduction },
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