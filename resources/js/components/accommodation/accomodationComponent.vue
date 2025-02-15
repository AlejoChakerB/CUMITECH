<template>
    <v-app>
        <v-row class="card-container">
            <v-col cols="12">
                <v-hover v-slot="{ hover }">
                    <div>
                        <v-row>
                            <v-col v-for="(card, index) in cards" :key="index" cols="12" sm="6" md="4" lg="3">
                                <a :href="getServiceRoute(card.route)" style="text-decoration: none;">
                                    <v-card
                                        :class="[`card-${index + 1}`, 'mx-auto', `custom-card-${index + 1}`, 'custom-breakpoint', { 'hovered': card.hovered }]"
                                        height="230" max-width="300" @mouseenter="setHovered(index, true)"
                                        @mouseleave="setHovered(index, false)">
                                        <v-card-text>
                                            <v-row class="text-end text-h6">
                                                <span>
                                                    <v-icon style="font-size: 200%;" :color="card.color">
                                                        mdi-bed
                                                    </v-icon>
                                                </span>
                                            </v-row>
                                        </v-card-text>
                                        <v-card-text>
                                            <v-row class="d-flex align-start">
                                                <h3 style="pointer-events: none;">{{ card.title }}</h3>
                                                <div class="text--white" style="pointer-events: none;">
                                                    {{ card.description }}
                                                </div>
                                            </v-row>
                                        </v-card-text>
                                        <v-card-text>
                                            <v-row no-gutters>
                                                <v-col class="d-flex justify-start">
                                                    <v-icon style="font-size: 200%;"
                                                        :color="card.hovered ? '#FFFF' : 'black'">mdi-arrow-right</v-icon>
                                                </v-col>
                                                <v-col class=" d-flex justify-end">
                                                    <span><v-img :src="card.image" width="70"
                                                            height="70"></v-img></span>
                                                </v-col>
                                            </v-row>
                                        </v-card-text>
                                    </v-card>
                                </a>
                            </v-col>
                        </v-row>
                    </div>
                </v-hover>
            </v-col>
        </v-row>
    </v-app>
</template>

<script>

import axios from 'axios';

export default {
    props: {
        imageSrc: {
            type: String,
            required: true
        },
        imageSrc2: {
            type: String,
            required: true
        },
        imageSrc3: {
            type: String,
            required: true
        },
        imageSrc4: {
            type: String,
            required: true
        },
        serviceRoute: String
    },
    data() {
        return {
            cards: [
                { hovered: false, title: 'HOSPITALIZACIÓN', description: 'Costos de estancias del servicio de hospitalización', image: this.imageSrc, color: "#32A997", route: 'HOSPITALIZACION' },
                { hovered: false, title: 'UCI', description: 'Costos de estancias del servicio de unidad de UCI', image: this.imageSrc2, color: "#F279A2", route: 'UCI' },
                { hovered: false, title: 'UCIM', description: 'Costos de estancias del servicio de UCI intermedia', image: this.imageSrc3, color: "#E8BD51", route: 'UCIM' },
                { hovered: false, title: 'URGENCIA', description: 'Costos de estancias del servicio de urgencias', image: this.imageSrc4, color: "#F53636", route: 'URGENCIAS' },
            ]
        };
    },
    methods: {
        setHovered(index, value) {
            this.cards[index].hovered = value;
        },

        getServiceRoute(route) {
            const baseUrl = this.serviceRoute;
            const serviceRoute = `?service=${route}`;
            return baseUrl + serviceRoute;
        }
    }
}
</script>

<style scoped lang="scss">
::v-deep .v-application--wrap {
    min-height: fit-content;
}
</style>

<style scoped>
/* Estilos card 1 */
.custom-card-1 {
    box-shadow: 0px 3px 6px -2px rgba(50, 169, 151, 1) !important;
}

.card-1.hovered {
    background: linear-gradient(to right, #1E9283, #42DBC4);
}

/* Estilos card 2 */
.custom-card-2 {
    box-shadow: 0px 3px 6px -2px rgba(242, 121, 161, 1) !important;
}

.card-2.hovered {
    background: linear-gradient(to right, #fc75bf, #ffabd8);
}

/* Estilos card 3 */
.custom-card-3 {
    box-shadow: 0px 3px 6px -2px rgba(232, 189, 81, 1) !important;
}

.card-3.hovered {
    background: linear-gradient(to right, #f1bb30, #ffe29a);
}

/* Estilos card 4 */
.custom-card-4 {
    box-shadow: 0px 3px 6px -2px rgba(245, 54, 54, 1) !important;
}

.card-4.hovered {
    background: linear-gradient(to right, #DF3131, #fc9a9a);
}


/* Estilos generales de cards */
.hovered .text--white {
    color: #ffffff !important;
    transition: color 0.3s ease-out;
}

.hovered h3 {
    color: #ffffff !important;
    transition: color 0.3s ease-out;

}

h3 {
    color: #2B3D63;
}

@media (min-width: 1264px) {
    .col-lg-3 {
        flex: 0 0 25%;
        max-width: none;
    }
}
</style>