<template>
    <!-- sidebar -->
    <div class="h-screen hidden md:block shadow-lg relative">
        <div class="bg-[#313131] h-full overflow-auto">
        <!-- Logo -->
        <div class="shrink-0 flex items-center justify-center mt-4">
            <Link :href="route('dashboard')">
            <ApplicationMark class="block w-16" />
            </Link>
        </div>
            <nav class="px-2 pt-10 text-white">
                <template v-for="(menu, index) in menus" :key="index">
                    <div v-if="menu.show">
                        <Accordion v-if="menu.options.length" :icon="menu.icon" :active="menu.active" :title="menu.label"
                            :id="index">
                            <div v-for="(option, index2) in menu.options" :key="index2">
                                <button @click="goToRoute(option.route)" v-if="option.show" :active="option.active"
                                    :title="option.label"
                                    class="w-full text-start pl-6 pr-2 mb-1 flex justify-between text-xs rounded-md py-1"
                                    :class="option.active ? 'bg-primary text-white' : 'hover:text-primary'">
                                    <p class="w-full truncate"> {{ option.label }}</p>
                                </button>
                            </div>
                        </Accordion>
                        <button v-else @click="goToRoute(menu.route)" v-if="menu.show" :active="menu.active" :title="menu.label"
                            class="w-full text-start px-2 mb-1 flex justify-between text-xs rounded-md py-1"
                            :class="menu.active ? 'bg-primary text-white' : 'hover:text-primary'">
                            <p class="w-full truncate"><span v-html="menu.icon"></span> {{ menu.label }}</p>
                        </button>
                    </div>
                </template>
            </nav>
        </div>
    </div>
</template>

<script>
import Accordion from './Accordion.vue';
import { Link } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';

export default {
    data() {
        return {
            collapsedMenu: null,
            menus: [
                {
                    label: 'Inicio',
                    icon: '<i class="fa-solid fa-house text-xs mr-2"></i>',
                    route: route('dashboard'),
                    active: route().current('dashboard'),
                    options: [],
                    dropdown: false,
                    show: true
                },
                // {
                //     label: 'Gestion de pagos',
                //     icon: '<i class="fa-solid fa-dollar-sign mr-2"></i>',
                //     route: route('payments.index'),
                //     active: route().current('payments.*'),
                //     options: [],
                //     dropdown: false,
                //     show: true
                // },
                // {
                //     label: 'Visitas',
                //     icon: '<i class="fa-solid fa-users text-sm mr-2"></i>',
                //     route: route('guests.index'),
                //     active: route().current('guests.*'),
                //     options: [],
                //     dropdown: false,
                //     show: true
                // },
                // {
                //     label: 'Reservación de áreas',
                //     icon: '<i class="fa-solid fa-leaf text-sm mr-2"></i>',
                //     route: route('common-areas-users.index'),
                //     active: route().current('common-areas-users.*'),
                //     options: [],
                //     dropdown: false,
                //     show: true
                // },
                // {
                //     label: 'Mantenimiento',
                //     icon: '<i class="fa-solid fa-screwdriver-wrench text-sm mr-2"></i>',
                //     route: route('maintenances.index'),
                //     active: route().current('maintenances.*'),
                //     options: [],
                //     dropdown: false,
                //     show: true
                // },
                // {
                //     label: 'Comunidad',
                //     icon: '<i class="fa-solid fa-people-roof text-sm mr-2"></i>',
                //     // route: route('posts.index'),
                //     active: route().current('posts.*') || route().current('community-events.*')|| route().current('neighbors.*'),
                //     options: [
                //         {
                //             label: 'Muro de noticias',
                //             route: route('posts.index'),
                //             show: true,
                //         },
                //         {
                //             label: 'Eventos',
                //             route: route('community-events.index'),
                //             show: true,
                //         },
                //         {
                //             label: 'Directorio de vecinos',
                //             route: route('neighbors.index'),
                //             show: true,
                //         },
                //     ],
                //     dropdown: true,
                //     show: true
                // },
                // {
                //     label: 'Normativas',
                //     icon: '<i class="fa-solid fa-sheet-plastic text-sm mr-2"></i>',
                //     route: route('norms.index'),
                //     active: route().current('norms.*'),
                //     options: [],
                //     dropdown: false,
                //     show: true
                // },
                // {
                //     label: 'Servicios',
                //     icon: '<i class="fa-solid fa-briefcase text-sm mr-2"></i>',
                //     route: route('services.index'),
                //     active: route().current('services.*'),
                //     options: [],
                //     dropdown: false,
                //     show: true
                // },
                // {
                //     label: 'Soporte técnico',
                //     icon: '<i class="fa-solid fa-headset text-sm mr-2"></i>',
                //     route: route('supports.create'), //si es residente manda a create, si es administrador manda a index
                //     active: route().current('supports.*'),
                //     options: [],
                //     dropdown: false,
                //     show: true
                // },
                
            ],
        }
    },
    components: {
        ApplicationMark,
        Accordion,
        Link
    },
    methods: {
        handleClickInMenu(index) {
            if (this.menus[index].options.length) {
                if (this.collapsedMenu === index) {
                    this.collapsedMenu = null;
                } else {
                    this.collapsedMenu = index;
                }
            } else {
                this.goToRoute(this.menus[index].route)
            }
        },
        goToRoute(route) {
            this.$inertia.get(route);
        }
    },
    mounted() {
    }
}
</script>