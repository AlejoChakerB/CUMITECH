<template>
  <v-app>
    <div class="custom-checkbox">
      <v-row>
        <v-col cols="12">
          <div v-for="(option, index) in paymentsJson" :key="index">
            <v-container class="px-0 pa-0" fluid>
              <v-switch v-model="selectedOptions" color="success" :value="option" :label="option.payment"
                hide-details></v-switch>
            </v-container>

          </div>
        </v-col>
      </v-row>
      <input type="hidden" name="payment" :value="selectedOptionsJson" />
    </div>
  </v-app>
</template>

<script>
import paymentsJson from './payment.json';

export default {
  name: 'CheckboxComponent',
  props: {
    selectedItems: {
      type: Array,
      default: () => [] // Valor predeterminado de un arreglo vacío
    }
  },
  data() {
    return {
      paymentsJson: paymentsJson,
      selectedOptions: [],
    };
  },
  mounted() {
    this.selectedOptions = this.selectedItems;
  },
  computed: {
    selectedOptionsJson() {
      // Verifica si hay elementos seleccionados
      if (this.selectedOptions.length > 0) {
        // Si hay elementos seleccionados, convierte el arreglo selectedOptions a JSON
        return JSON.stringify(this.selectedOptions);
      } else {
        // Si no hay elementos seleccionados, devuelve una cadena vacía
        return '';
      }
    }
  },
  watch: {
    selectedOptions: {
      handler(newVal) {
        // Actualiza el prop selectedItems cada vez que selectedOptions cambie
        this.$emit('update:selectedItems', newVal);
      },
      deep: true // Observa cambios profundos en el arreglo
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
.v-switch .label {
  color: black;
}
</style>