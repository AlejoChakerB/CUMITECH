<template>
  <div id="app">
    <div class="signature-container">
      <vueSignaturePad
        id="employe_signature" 
        width="100%" 
        height="140px" 
        name="employe_signature" 
        v-model="employe_signature" 
        ref="signaturePad"
        :options="options"
      ></vueSignaturePad>
    </div>

    <div class="buttons"> 
      <button @click.prevent="save" class="btn btn-default"><span class="fas fa-check-circle" style="color: #69C5A0; font-size:larger;"></span></button>
      <button @click.prevent="clear" class="btn btn-default"><span class="fas fa-times-circle" style="color: #da1b1b; font-size: larger;"></span></button>
    </div>
    <div>
      <label>
        <input type="hidden" name="employe_signature" v-model="employe_signature">
      </label>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { VueSignaturePad } from 'vue-signature-pad';

export default defineComponent({
  name: 'MySignaturePad',
  components: { VueSignaturePad },
  props: {
    initialSignature: {
      type: String,
      default: null
    }
  },
  data() {
    return {
      employe_signature: this.initialSignature || '',
      options: {
        minWidth: 0.5,
        maxWidth: 1.5,
      },
    };
  },
  mounted() {
    // Actualizar la firma en tiempo real
    this.$refs.signaturePad.$on('signatureInput', (signatureData) => {
      this.employe_signature = signatureData;
    });
  },
  methods: {
    clear() {
      this.$refs.signaturePad.clearSignature();
    },
    save() {
      const { isEmpty, data } = this.$refs.signaturePad.saveSignature();
      console.log(isEmpty);
      this.employe_signature = data;
      console.log(this.employe_signature);
    },
  },
});
</script>

<style>
#employe_signature {
  border: double 2px transparent;
  border-radius: 5px;
  background-image: linear-gradient(white, white),
    radial-gradient(circle at top left, lightgreen, #14ABE3);
  background-origin: border-box;
  background-clip: content-box, border-box;
  width: 100%;
  height: auto; /* Esto mantiene la proporción de la altura según el ancho */
}

.buttons {
  display: flex;
  gap: 8px;
  justify-content: center;
  margin-top: 8px;
}

.signature-container {
  max-width: 1000px; /* Define el ancho máximo deseado para el lienzo de la firma en dispositivos móviles */
  margin: 0 auto;   /* Centra el contenedor horizontalmente */
  padding: 10px;    /* Agrega un espacio alrededor del lienzo de la firma */
}
</style>
