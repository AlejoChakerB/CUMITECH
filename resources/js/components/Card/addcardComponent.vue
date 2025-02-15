<template>
    <v-app>
        <v-row justify="center">
            <v-dialog v-model="dialog" persistent max-width="600px">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn icon color="primary" dark v-bind="attrs" v-on="on">
                        <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="text-h5">Registrar entrega de carnet</span>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" sm="12" md="12">
                                    <v-select :options="employees" label="name" placeholder="Seleccione un empleado"
                                        :value="employees.id" :components="customSelect"
                                        :get-option-label="(option) => option.name">
                                        <div slot="no-options">Sin resultados...</div>

                                        <template #option="{ dni, name }">
                                            {{ dni }}
                                            <br />
                                            <cite>{{ name }}</cite>
                                        </template>
                                    </v-select>
                                </v-col>
                                <v-col cols="12" sm="12" md="12">
                                    <v-menu v-model="menu2" :close-on-content-click="false" :nudge-right="40"
                                        transition="scale-transition" offset-y min-width="auto">

                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field v-model="date" label="Picker without buttons"
                                                prepend-icon="mdi-calendar" readonly v-bind="attrs"
                                                v-on="on" solo clearable></v-text-field>
                                        </template>
                                        <v-date-picker v-model="date" @input="menu2 = false" color="green lighten-1"></v-date-picker>
                                    </v-menu>
                                </v-col>
                                <v-col cols="12" sm="12" md="12">
                                    <signature-pad></signature-pad>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="dialog = false">
                            Close
                        </v-btn>
                        <v-btn color="blue darken-1" text @click="dialog = false">
                            Save
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </v-app>
</template>

<script>

import axios from 'axios'

export default {
    props: {
        route: String
    },
    data() {
        return {
            dialog: false,
            employees: [],
            customSelect: {
                Deselect: {
                    render: createElement => createElement('span', '❌'),
                },
            },
            date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
            menu2: false,
        };
    },
    mounted() {
        this.fetchEmployees()
    },
    methods: {
        fetchEmployees() {
            axios.get(`${this.route}api/employes`)
                .then(response => {
                    this.employees = response.data.data
                    console.log(this.employees);
                })
                .catch(error => {
                    console.error(error)
                })
        }
    }
}
</script>

<style scoped lang="scss">
::v-deep .v-application--wrap {
    min-height: fit-content;
}
</style>