<template>
  <div class="row mt-1">
    <div class="form-group row">
      <!-- template name Field -->
      <div class="form-group col-sm-4">
        <label for="details">Nombre de plantilla:<span style="color: red;">*</span></label>
        <input type="text" v-model="template_name" class="form-control" name="template_name"
          placeholder="Ingrese el nombre de la plantilla" />
      </div>
      <!-- Invima registrations id Field -->
      <div class="form-group col-sm-4">
        <label clas for="item">Registro invima:<span style="color: red;">*</span></label>
        <select v-model="selectedCategory" class="form-control" name="invima_registrations_id" ref="invima_registration">
          <option v-for="category in data" :value="category.id">{{ category.health_register }} - {{ category.tradename }}
          </option>
        </select>
      </div>
      <!-- Generic name Field -->
      <div class="form-group col-sm-4">
        <label for="details">Nombre genérico:</label>
        <input type="text" v-model="generic_name" class="form-control" placeholder="Ingrese el nombre genérico" />
      </div>
    </div>
    <div class="form-group row">
      <!-- Tradename Field -->
      <div class="form-group col-sm-4">
        <label for="details">Nombre comercial:</label>
        <input type="text" v-model="tradename" class="form-control" placeholder="Ingrese el nombre comercial" />
      </div>
      <!-- Pharmaceutical Formt Field -->
      <div class="form-group col-sm-4">
        <label for="details">Forma farmaceutica:</label>
        <input type="text" v-model="pharmaceutical_form" class="form-control"
          placeholder="Ingrese la forma farmaceutica" />
      </div>
      <!-- Validity registration Field -->
      <div class="form-group col-sm-4" style="margin: 0, 0, 16px;  height: 94px;">
        <v-app>
          <label for="details">Vigencia del registro (yyyy-mm-dd) :</label>
          <v-menu v-model="menu2" :close-on-content-click="false" :nudge-right="60" transition="scale-transition" offset-y
            min-width="90%" style="margin-bottom: -16px;">
            <template v-slot:activator="{ on, attrs }">
              <input type="text" v-model="validity_registration" class="form-control"
                placeholder="Ingrese la fecha de vencimiento" v-bind="attrs" v-on="on" />
            </template>
            <v-date-picker v-model="validity_registration" @input="menu2 = false" locale="Es" no-title
              color="green"></v-date-picker>
          </v-menu>
        </v-app>
      </div>
    </div>

    <div class="form-group row">
      <!-- Laboratory manufacturer Field -->
      <div class="form-group col-sm-4">
        <label for="details">Laboratorio fabricante:</label>
        <input type="text" v-model="laboratory_manufacturer" class="form-control"
          placeholder="Ingrese el laboratorio fabricante" />
      </div>
      <!-- Concentrationt Field -->
      <div class="form-group col-sm-4">
        <label for="details">Concentracion:<span style="color: red;">*</span></label>
        <input type="text" v-model="concentrationt" class="form-control" name="concentrationt"
          placeholder="Ingrese la concentracion" />
      </div>
      <!-- Concentrationt Field -->
      <div class="form-group col-sm-4">
        <label for="details">Presentación:<span style="color: red;">*</span></label>
        <input type="text" v-model="presentationt" class="form-control" name="presentationt"
          placeholder="Ingrese la presentación" />
      </div>
    </div>
    <div class="form-group row">
      <!-- Received Amountt Field -->
      <div class="form-group col-sm-4">
        <label for="details">Cantidad recibidas:<span style="color: red;">*</span></label>
        <input type="number" v-model="received_amountt" class="form-control" name="received_amountt"
          placeholder="Ingrese la cantidad recibida" />
      </div>
      <!-- Samplet Field -->
      <div class="form-group col-sm-4">
        <label for="details">Muestras:<span style="color: red;">*</span></label>
        <input type="number" v-model="samplet" class="form-control" name="samplet"
          placeholder="Ingrese la cantidad de muestras" />
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    data: {
      type: Array // Define el tipo de dato como Array
    },
    select: {
      type: Array,
      default: []
    },
  },
  data() {
    return {
      selectedCategory: null,
      //Datos de plantilla
      template_name: '',
      concentrationt: '',
      presentationt: '',
      received_amountt: '',
      samplet: '',
      //Datos de tabla invima
      validity_registration:  (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      laboratory_manufacturer: '',
      tradename: '',
      pharmaceutical_form: '',
      generic_name: '',
      //calendario
      menu2: false,
    };
  },

  mounted() {
    //date

    //Referencia al contexto del componente Vue
    const vm = this;

    //Select2
    const $select2 = $(this.$refs.invima_registration).select2({
      placeholder: "Seleccione la forma farmaceutica",
      allowClear: true,
      width: "100%",
      theme: "bootstrap4",
      language: {
        noResults: function () {
          return "No se encontraron resultados";
        },
        searching: function () {
          return "Buscando...";
        },
      }
    });

    //Valor por defecto si está disponible
    if (this.$attrs['medicationtemplate']) {
      this.template_name = this.$attrs['medicationtemplate'].template_name;
      this.concentrationt = this.$attrs['medicationtemplate'].concentrationt;
      this.presentationt = this.$attrs['medicationtemplate'].presentationt;
      this.received_amountt = this.$attrs['medicationtemplate'].received_amountt;
      this.samplet = this.$attrs['medicationtemplate'].samplet;

      // Establece el valor por defecto utilizando la opción data de Vue.js
      this.$nextTick(() => {
        $select2.val(this.$attrs['medicationtemplate'].invima_registrations_id).trigger('change');
      });
    }

    // Maneja el evento de cambio de Select2
    $select2.on('change', function () {
      vm.selectedCategory = $(this).val(); // Actualiza la propiedad selectedCategory usando la referencia vm
    });
  },

  watch: {
    selectedCategory(newCategoryId) {
      if (newCategoryId) {
        // Busca los detalles de la categoría en los datos cargados
        const selectedCategory = this.data.find(category => category.id === parseInt(newCategoryId));

        // Actualiza los detalles en la propiedad selectedCategoryDetails
        if (selectedCategory) {
          this.validity_registration = `${selectedCategory.validity_registration}`;
          this.laboratory_manufacturer = `${selectedCategory.laboratory_manufacturer}`;
          this.tradename = `${selectedCategory.tradename}`;
          this.pharmaceutical_form = `${selectedCategory.pharmaceutical_form}`;
          this.generic_name = `${selectedCategory.generic_name}`;
        } else {
          this.validity_registration = '';
          this.laboratory_manufacturer = '';
          this.tradename = '';
          this.pharmaceutical_form = '';
          this.generic_name = '';
        }
      } else {
        this.validity_registration = '';
        this.laboratory_manufacturer = '';
        this.tradename = '';
        this.pharmaceutical_form = '';
        this.generic_name = '';
      }
    },
    validity_registration(newVal) {
      // Verifica si la entrada es válida antes de formatear
      if (/^\d{4}\/\d{2}\/\d{2}$/.test(newVal)) {
        const parts = newVal.split('/');
        const formattedDate = `${parts[0]}-${parts[1]}-${parts[2]}`;
        this.validity_registration = formattedDate;
      }
    },
  }
};
</script>
<style scoped lang="scss">
::v-deep .v-application--wrap {
  min-height: fit-content;
}
</style>

<style>
.select2-selection__clear {
  position: absolute;
  right: 5%;
}
</style>