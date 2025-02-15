<template>
    <div id="app">
        <v-select v-model="selectedOptions" :options="filteredOptions" :loading="loading" multiple label="description"
            placeholder="Selecciona las opciones" @search="searchOptions" @open="loadOptions">{option.value}</v-select>
        <input type="text" name="items" :value="selectedItemsJson">
    </div>
</template>

<script>
export default {
    props: {
        edit: {
            type: Object
        }
    },
    data() {
        return {
            selectedOptions: [],
            options: [],
            getOptions: [],
            filteredOptions: [],
            currentPage: 1,
            pageSize: 10,
            totalPages: 0,
            loading: false,
            searchText: ""
        }
    },
    computed: {
        selectedItemCodes() {
            return this.selectedOptions.map(option => option.value);
        },
        selectedItemsJson() {
            return JSON.stringify(this.selectedItemCodes);
        },
        paginatedOptions() {
            const startIndex = (this.currentPage - 1) * this.pageSize;
            const endIndex = startIndex + this.pageSize;
            return this.options.slice(startIndex, endIndex);
        }
    },
    mounted() {
        if (this.edit) {
            this.searchValues()
        }
    },
    methods: {
        loadOptions() {
            if (this.options.length === 0) {
                this.loading = true;
                axios.get('http://10.1.5.81/CUMI/public/api/articles')
                    .then(response => {
                        try {
                            this.options = response.data.data.map(article => ({
                                value: article.item_code,
                                description: article.description
                            }));
                            this.totalPages = Math.ceil(this.options.length / this.pageSize);
                            /* if (this.edit && this.edit.items) {
                                // Si edit.items existe, convierte la cadena JSON en un arreglo y busca esos valores dentro de options
                                const itemsArray = JSON.parse(this.edit.items);
                                this.searchValues(itemsArray);
                            } */
                            this.filteredOptions = this.options.slice(0, this.pageSize);
                            this.loading = false;
                        } catch (error) {
                            console.error('Error:', error);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
            }
        },
        searchValues() {
            const itemsArray = JSON.parse(this.edit.items);
            const foundOptions = [];
            itemsArray.map(item => {
                axios.get(`http://10.1.5.81/CUMI/public/api/articles/showCode/${item}`)
                    .then(response => {
                        this.getOptions = {
                            value: response.data.data.item_code,
                            description: response.data.data.description
                        };
                        if (this.getOptions) {
                            console.log(this.getOptions);
                            const foundOption = this.getOptions;
                            if (foundOption) {
                                foundOptions.push({ value: foundOption.value, description: foundOption.description });
                                console.log('Valor encontrado:', foundOption);
                            } else {
                                console.log('Valor no encontrado:', value);
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        return null;
                    });
            });
            this.selectedOptions = foundOptions;
        },
        searchOptions(search) {
            clearTimeout(this.searchTimeout);
            this.loading = true;
            this.searchText = search;
            this.searchTimeout = setTimeout(() => {
                this.filteredOptions = this.options.filter(option =>
                    option.description.toLowerCase().includes(this.searchText.toLowerCase())
                );
                this.loading = false;
            }, 500);
        }
    }
}
</script>

<style scoped lang="scss">
::v-deep .v-application--wrap {
    min-height: fit-content;
}
</style>
