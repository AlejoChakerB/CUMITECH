<template>
  <div class="custom-checkbox">
    <div v-for="(option, index) in options" :key="index">
      <label class="custom-control custom-checkbox">
        <input type="checkbox" :value="option.value" v-model="modelValue" name="item[]" class="custom-control-input">
        <span class="custom-control-label">{{ option.label }}</span>
      </label>
    </div>
  </div>
</template>


<script>
export default {
  name: "CheckboxComponent",
  props: {
    selectedItems: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      options: [
        { label: 'Zapatos', value: 'zapatos' },
        { label: 'Pantalon', value: 'pantalon' },
        { label: 'Camisa', value: 'camisa' },
        { label: 'Cinturon', value: 'cinturon' }
      ],
      modelValue: []
    };
  },
  mounted() {
    this.modelValue = this.selectedItems;
  }
};
</script>
