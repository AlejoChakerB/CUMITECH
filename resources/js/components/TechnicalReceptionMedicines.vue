<template>
    <div class="row mt-1">
        <div class="form-group row">
            <!-- Admission Date Field -->
            <div class="form-group col-sm-3">
                <v-app>
                    <label for="details">Fecha de ingreso:</label>
                    <v-menu v-model="menu" :close-on-content-click="false" :nudge-right="60" transition="scale-transition"
                        offset-y min-width="127%" style="margin-bottom: -16px;">
                        <template v-slot:activator="{ on, attrs }">
                            <input type="text" v-model="admission_date" name="admission_date" class="form-control"
                                placeholder="Ingrese la fecha de ingreso" v-bind="attrs" v-on="on" />
                        </template>
                        <v-date-picker v-model="admission_date" @input="menu = false" locale="Es" no-title
                            color="green"></v-date-picker>
                    </v-menu>
                </v-app>
            </div>
            <!-- Act Number Field -->
            <div class="form-group col-sm-3">
                <label for="details">Número de acta:</label>
                <input type="text" v-model="act_number" class="form-control" name="act_number"
                    placeholder="Ingresa el número de acta" />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label for="details">Plantilla:</label>
                <v-select v-model="selectedCategory" :options="dataTemplate" ref="selectedCategory"
                    :components="customSelect" placeholder="Seleccione la plantilla">
                    <div slot="no-options">Sin resultados...</div>
                </v-select>
            </div>
            <div class="form-group col-sm-3">
                <label for="details">Nombre generico:</label>
                <input type="text" v-model="generic_name" class="form-control" name="generic_name"
                    placeholder="Ingrese el nombre generico" />
            </div>
            <div class="form-group col-sm-3">
                <label for="details">Nombre comercial:</label>
                <input type="text" v-model="tradename" class="form-control" name="tradename"
                    placeholder="Ingrese el nombre comercial" />
            </div>
            <div class="form-group col-sm-3">
                <label for="details">Concentracion:</label>
                <input type="text" v-model="concentrationt" class="form-control" name="concentration"
                    placeholder="Ingrese la concentracion" />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label clas for="item">Forma farmaceutica:</label>
                <input type="hidden" name="pharmaceutical_form" v-model="pharmaceutical_form_Value">
                <v-select :options="dataPh" @input="setTemplate" v-model="pharmaceutical_form" :components="customSelect"
                    placeholder="Seleccione la forma farmaceutica">
                    <div slot="no-options">Sin resultados...</div>
                </v-select>
            </div>
            <div class="form-group col-sm-3">
                <label for="details">Presentacion:</label>
                <input type="text" v-model="presentationt" class="form-control" name="presentation"
                    placeholder="Ingrese la presentacion" />
            </div>
            <div class="form-group col-sm-3">
                <label for="details">Registro invima:</label>
                <input type="hidden" name="invima_registrations_id" v-model="invima_registrations_value">
                <v-select v-model="invima_registrations_id" :options="dataInvima" :components="customSelect"
                    placeholder="Seleccione el registro invima">
                    <div slot="no-options">Sin resultados...</div>
                </v-select>
            </div>
            <div class="form-group col-sm-3">
                <label for="details">Laboratorio fabricante:</label>
                <input type="text" v-model="manufacturer_laboratory" class="form-control" name="manufacturer_laboratory"
                    placeholder="Ingrese el laboratorio fabricante" />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <v-app>
                    <label for="details">Vigencia del registro:</label>
                    <v-menu v-model="menu2" :close-on-content-click="false" :nudge-right="60" transition="scale-transition"
                        offset-y min-width="127%" style="margin-bottom: -16px;">
                        <template v-slot:activator="{ on, attrs }">
                            <input type="text" v-model="registration_validity" name="registration_validity"
                                class="form-control" placeholder="Ingrese la fecha de vigencia" v-bind="attrs" v-on="on" />
                        </template>
                        <v-date-picker v-model="registration_validity" @input="menu2 = false" locale="Es" no-title
                            color="green"></v-date-picker>
                    </v-menu>
                </v-app>
            </div>
            <div class="form-group col-sm-3">
                <label for="details">Muestras recibidas:</label>
                <input type="text" v-model="received_amountt" class="form-control" name="received_amount"
                    placeholder="Ingrese las muestras recibidas" />
            </div>
            <div class="form-group col-sm-3">
                <label for="details">Cantidad recibida:</label>
                <input type="text" v-model="samplet" class="form-control" name="sample"
                    placeholder="Ingrese la cantidad recibida" />
            </div>
        </div>
        <table class="table table-bordered table-centered">
            <thead class="text-center">
                <tr>
                    <th>Descripcion
                        <v-dialog transition="dialog-bottom-transition" max-width="800" style="margin-bottom: 5px">
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn class="ma-2" text icon>
                                    <v-icon style="color: rgba(34, 154, 170, 0.87)" v-bind="attrs"
                                        v-on="on">mdi-information-outline</v-icon>
                                </v-btn>
                            </template>
                            <template v-slot:default="dialog">
                                <v-card>
                                    <v-card-text>
                                        <table class="table table-bordered table-centered">
                                            <thead class="text-center">
                                                <tr>
                                                    <th style="color: rgba(34, 154, 170, 0.87)">Descripcion</th>
                                                    <th style="color: red">Critico</th>
                                                    <th style="color: red">Mayor</th>
                                                    <th style="color: orange">Menor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label>ROTULACION</label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Falta de información: nombre genérico, registro sanitario,
                                                            forma, lote, vencimiento, formulación, cantidad, fabricante,
                                                            condiciones almacenamiento (si aplica), vía de administración,
                                                            leyenda "agítese antes de usar" en suspensiones. Impresión
                                                            defectuosa, ilegible o inconsistente entre empaques.
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Ausencia de la cantidad o volumen contenido, (CRÍTICO para
                                                            soluciones estériles). Ausencia de la formulación del producto
                                                            por unidad posológica sin necesidad de especificar excipientes
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Etiquetas mal alineadas o adheridas incorrectamente (mayor
                                                            importancia para medicamentos que requieren reconstitución con
                                                            señal de precaución).
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>LAMINADO</label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Blister sin número de lote y/o sin fecha de vencimiento.
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Laminado roto, llenado incompleto, manchas
                                                            o suciedad al interior del blister.
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Superficie arrugada, rayada o sucia
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>CIERRE</label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Ausencia de: cierre o banda de seguridad, agrafe si se requiere,
                                                            perforaciones para apertura. Deficiente hermeticidad del cierre,
                                                            cierre roto, agrafe mal ajustado.
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Grafado defectuoso
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>TODAS</label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Color no característico o no homogéneo, partículas extrañas,
                                                            ausencia o menos contenido, Olor extraño.
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>LIQUIDOS</label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Fluidez inadecuada, sedimento precipitado o turbidez
                                                            (soluciones). Sedimento no redispersable (suspensiones).
                                                            Separación de fases (emulsiones). Presencia de cristales
                                                            (estériles), excepto si la monografía lo admite.
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>SEMISOLIDOS</label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Separación de fases, consistencia inadecuada.
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>POLVO</label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Compactación del polvo (estériles), compactación de polvos y
                                                            granulados (No estériles)
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>TABLETA</label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Manchadas o laminadas, ruptura o porosidad de la cubierta
                                                            (recubiertas o grageas)
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Bordes erosionados y/o tabletas rotas
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>CAPSULAS</label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Rotas, quebradizas, porosas o con cierre defectuoso.
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            Deformadas, con suciedad exterior.
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                        </label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </v-card-text>
                                    <v-card-actions class="justify-end">
                                        <v-btn @click="dialog.value = false" depressed color="primary">Cerrar</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </template>
                        </v-dialog>
                    </th>
                    <th>Critico</th>
                    <th>Mayor</th>
                    <th>Menor</th>
                    <th>Optimo</th>
                    <th>NA</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr v-for="(item, index) in items" :key="index">
                    <td>
                        <label for="description" class="w-100"><span>{{ item.description }}</span></label>
                    </td>
                    <td>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-danger" type="radio" :name="item.name"
                                :id="'value' + index + 'Critico'" value="Critico" v-model="item.value" />
                            <label class="custom-control-label" :for="'value' + index + 'Critico'"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-danger" type="radio" :name="item.name"
                                :id="'value' + index + 'Mayor'" value="Mayor" v-model="item.value" />
                            <label class="custom-control-label" :for="'value' + index + 'Mayor'"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-orange" type="radio" :name="item.name"
                                :id="'value' + index + 'Menor'" value="Menor" v-model="item.value" />
                            <label class="custom-control-label" :for="'value' + index + 'Menor'"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-success" type="radio" :name="item.name"
                                :id="'value' + index + 'Optimo'" value="Optimo" v-model="item.value" />
                            <label class="custom-control-label" :for="'value' + index + 'Optimo'"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-secondary" type="radio"
                                :name="item.name" :id="'value' + index + 'NA'" value="NA" v-model="item.value" />
                            <label class="custom-control-label" :for="'value' + index + 'NA'"></label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Lot Number Field -->
        <div class="form-group row">
            <div class="col-sm-3">
                <v-app>
                    <label for="details">Fecha de vencimiento:</label>
                    <v-menu v-model="menu3" :close-on-content-click="false" :nudge-right="60" transition="scale-transition"
                        offset-y min-width="127%" style="margin-bottom: -16px;">
                        <template v-slot:activator="{ on, attrs }">
                            <input type="text" v-model="expiration_date" name="expiration_date" class="form-control"
                                placeholder="Ingrese la fecha de ingreso" v-bind="attrs" v-on="on" />
                        </template>
                        <v-date-picker v-model="expiration_date" @input="menu3 = false" locale="Es" no-title
                            color="green"></v-date-picker>
                    </v-menu>
                </v-app>
            </div>
            <div class="col-sm-3">
                <label for="details">Número de lote:</label>
                <input type="text" v-model="lot_number" class="form-control" name="lot_number"
                    placeholder="Ingrese el npumero de lote" />
            </div>
            <!-- Supplier Field -->
            <div class="col-sm-3">
                <label for="details">Proveedor:</label>
                <input type="text" v-model="supplier" class="form-control" name="supplier"
                    placeholder="Ingrese el proveedor" />
            </div>
            <!-- Invoice Number Field -->
            <div class="col-sm-3">
                <label for="details">Número de factura:</label>
                <input type="text" v-model="invoice_number" class="form-control" name="invoice_number"
                    placeholder="Ingrese el número de factura" />
            </div>
        </div>
    </div>
</template>

<script>
import TEMPLATES from '../utils/index.js';
import { options } from '../utils/options.js';
export default {
    name: 'TechnicalReceptionMedicines',
    props: {
        data: {
            type: Array // Define el tipo de dato como Array
        },
        invima: {
            type: Array // Define el tipo de dato como Array
        },
        act_number2: {
            type: Number
        },
        last_fact: {
            type: Number
        },
        medicine: {
            type: Object
        }
    },
    data() {
        return {
            items: [],
            template: '', // Agrega la propiedad template
            selectedTemplate: 'TEMPLATE_ONE', // Agrega la propiedad selectedTemplate
            options: options, //Opciones para formas farmaceutica
            selectedCategory: null,
            invima_registrations_id: null,
            invima_registrations_value: '',
            admission_date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
            registration_validity: '',
            generic_name: '',
            tradename: '',
            concentrationt: '',
            pharmaceutical_form: null,
            pharmaceutical_form_Value: '',
            presentationt: '',
            manufacturer_laboratory: '',
            received_amountt: '',
            samplet: '',
            expiration_date: '',
            lot_number: '',
            supplier: '',
            invoice_number: this.last_fact,
            act_number: this.act_number2,
            //Date pickers
            menu: false, menu2: false, menu3: false,
            //Opciones para V-selects
            dataTemplate: this.buildOptions(this.data),
            dataInvima: this.buildOptionsInvima(this.invima),
            dataPh: this.buildOptionsPF(options),
            customSelect: {
                Deselect: {
                    render: createElement => createElement('span', '❌'),
                },
            },

        }
    },
    mounted() {
        if (this.medicine) {
            this.admission_date = this.medicine.admission_date.substring(0, 10);
            this.act_number = this.medicine.act_number;
            this.generic_name = this.medicine.generic_name;
            this.tradename = this.medicine.tradename;
            this.concentrationt = this.medicine.concentration;
            this.presentationt = this.medicine.presentation;
            this.expiration_date = this.medicine.expiration_date.substring(0, 10);
            this.registration_validity = this.medicine.registration_validity.substring(0, 10);
            this.manufacturer_laboratory = this.medicine.manufacturer_laboratory;
            this.supplier = this.medicine.supplier;
            this.invoice_number = this.medicine.invoice_number;
            this.received_amountt = this.medicine.received_amount;
            this.samplet = this.medicine.sample;
            this.lot_number = this.medicine.lot_number;
            const selectedCategory2 = this.invima.find(category => category.id === this.medicine.invima_registrations_id);
            this.invima_registrations_id = {
                value: selectedCategory2.id,
                label: selectedCategory2.health_register
            };
            this.invima_registrations_value = this.invima_registrations_id.value;
            const selectedCategory3 = this.dataPh.find(category => category.label === this.medicine.pharmaceutical_form);
            this.pharmaceutical_form = selectedCategory3;
            this.pharmaceutical_form_Value = selectedCategory3.label;
            this.selectedTemplate = selectedCategory3.value;
            this.items = TEMPLATES[this.selectedTemplate];

        }
    },
    methods: {
        setTemplate(selectedValue) {
            //const selectedDisplayValue = Object.entries(this.options).find(([key, value]) => value === selectedValue.value)[0];
            this.pharmaceutical_form_Value = selectedValue.label;
            this.selectedTemplate = selectedValue.value;
            this.items = TEMPLATES[this.selectedTemplate];
            //Si this.medicina no es nulo asigna lo valores que trae el prop
            this.$nextTick(() => {
                if (this.medicine) {
                    this.items.forEach(item => {
                        if (item.name == "lettering") {
                            item.value = this.medicine.lettering;
                        } else if (item.name == "packing") {
                            item.value = this.medicine.packing;
                        } else if (item.name == "laminate") {
                            item.value = this.medicine.laminate;
                        } else if (item.name == "closing") {
                            item.value = this.medicine.closing;
                        } else if (item.name == "all") {
                            item.value = this.medicine.all;
                        } else if (item.name == "liquids") {
                            item.value = this.medicine.liquids;
                        } else if (item.name == "semisolid") {
                            item.value = this.medicine.semisolid;
                        } else if (item.name == "dust") {
                            item.value = this.medicine.dust;
                        } else if (item.name == "tablet") {
                            item.value = this.medicine.tablet;
                        } else if (item.name == "capsule") {
                            item.value = this.medicine.capsule;
                        }
                    });
                } else {
                    this.items.forEach(item => {
                        item.value = "Optimo";
                    });
                }
            });
        },
        buildOptions(data) {
            // Convierte el arreglo JSON en el formato esperado por vue-select
            return data.map(item => ({ value: item.id, label: item.template_name }));
        },
        buildOptionsInvima(data) {
            // Convierte el arreglo JSON en el formato esperado por vue-select
            return data.map(item => ({ value: item.id, label: item.health_register }));
        },
        buildOptionsPF(options) {
            // Convierte el arreglo JSON en el formato esperado por vue-select
            return Object.entries(options).map(([value, label]) => ({ value, label }));
        },
    },
    watch: {
        selectedCategory(newCategoryId) {
            if (newCategoryId) {
                // Busca los detalles de la categoría en los datos cargados
                const selectedCategory = this.data.find(category => category.id === newCategoryId.value);
                // Actualiza los detalles en la propiedad selectedCategoryDetails
                if (selectedCategory) {
                    this.concentrationt = `${selectedCategory.concentrationt}`;
                    this.presentationt = `${selectedCategory.presentationt}`;
                    this.received_amountt = `${selectedCategory.received_amountt}`;
                    this.samplet = `${selectedCategory.samplet}`;
                    // Llama a invima_registrations_id con el id de la categoría seleccionada
                    const invimaId = selectedCategory.invima_registrations_id;
                    const selectedCategory2 = this.invima.find(category => category.id === invimaId);
                    this.invima_registrations_id = {
                        value: selectedCategory2.id,
                        label: selectedCategory2.health_register
                    };
                    this.invima_registrations_value = this.invima_registrations_id.value;
                }
            } else {
                this.concentrationt = '';
                this.presentationt = '';
                this.received_amountt = '';
                this.samplet = '';
                this.invima_registrations_id = '';
            }
        },
        invima_registrations_id(newCategoryId) {
            if (newCategoryId) {
                // Busca los detalles de la categoría en los datos cargados
                const selectedCategory = this.invima.find(category => category.id === newCategoryId.value);
                // Actualiza los detalles en la propiedad selectedCategoryDetails
                if (selectedCategory) {
                    this.registration_validity = `${selectedCategory.validity_registration}`;
                    this.manufacturer_laboratory = `${selectedCategory.laboratory_manufacturer}`;
                    this.generic_name = `${selectedCategory.generic_name}`;
                    this.tradename = `${selectedCategory.tradename}`;
                    this.pharmaceutical_form = `${selectedCategory.pharmaceutical_form}`;
                    this.selectedTemplate = this.pharmaceutical_form;
                    this.invima_registrations_value = newCategoryId.value;
                    // Usa selectedDisplayValue como desees, por ejemplo, puedes pasarlo como parámetro a otra función
                    const selectedCategory3 = this.dataPh.find(category => category.label === this.pharmaceutical_form);
                    this.setTemplate(selectedCategory3);
                }
            } else {
                this.registration_validity = '';
                this.manufacturer_laboratory = '';
                this.generic_name = '';
                this.tradename = '';
                this.pharmaceutical_form = '';
            }
        },
        pharmaceutical_form(newDateTemplate) {
            if (!newDateTemplate) {
                this.items = '';
            }
        },
        admission_date(newVal) {
            // Verifica si la entrada es válida antes de formatear
            if (/^\d{4}\/\d{2}\/\d{2}$/.test(newVal)) {
                const parts = newVal.split('/');
                const formattedDate = `${parts[0]}-${parts[1]}-${parts[2]}`;
                this.admission_date = formattedDate;
            }
        },
        registration_validity(newVal) {
            // Verifica si la entrada es válida antes de formatear
            if (/^\d{4}\/\d{2}\/\d{2}$/.test(newVal)) {
                const parts = newVal.split('/');
                const formattedDate = `${parts[0]}-${parts[1]}-${parts[2]}`;
                this.registration_validity = formattedDate;
            }
        }
    }
}
</script>
<style scoped lang="scss">
::v-deep .v-application--wrap {
    min-height: fit-content;
}
</style>