<template>
    <Dropdown @click="readNotifications()" align="right" width="notifications" class="mt-2 mr-2" :closeInClick="false">
        <template #trigger>
            <button class="ml-6 relative" :class="getUnreadMessages.length ? 'text-primary' : 'text-[#97989A]'">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bell"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                </svg>
            </button>
            <span v-if="getUnreadMessages.length"
                class="w-4 h-4 bg-primary text-white text-[9px] rounded-full absolute -top-1 -right-2 flex items-center justify-center border border-white">
                {{ getUnreadMessages.length }}
            </span>
        </template>
        <template #content>
            <h1 class="font-bold text-center text-sm mt-2">Notificaciones</h1>
            <p v-if="!notifications.length" class="text-gray3 text-xs text-center my-3">No hay notificaciones</p>
            <main class="max-h-[220px] overflow-y-auto">
                <DropdownLink v-for="item in notifications" :key="item.id" :href="item.data.url">
                    <div :class="{ 'font-bold': item.read_at === null }" class="relative">
                        <div v-if="item.read_at === null"
                            class="w-2 h-2 bg-primary rounded-full absolute top-[6px] -left-3"></div>
                        <p v-html="item.data.description"></p>
                    </div>
                    <small class="mt-1 text-gray2">{{ item.created_at_for_humans }}</small>
                </DropdownLink>
            </main>
            <footer v-if="notifications.length" class="py-1 px-2 flex justify-end">
                <el-popconfirm confirm-button-text="Si" cancel-button-text="No" icon-color="#FD8827"
                    title="¿Desea eliminar todas las notificaciones?" @confirm="deleteNotifications()">
                    <template #reference>
                        <button class="text-xs bg-primary text-white rounded-full px-2 py-1">Eliminar todo</button>
                    </template>
                </el-popconfirm>
            </footer>
        </template>
    </Dropdown>
</template>
  
<script>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from "axios";

export default {
    data() {
        return {
            showNotificationPopup: false,
            notifications: [],
            selectedNotifications: [],
        };
    },
    components: {
        Dropdown,
        DropdownLink,
        PrimaryButton
    },
    methods: {
        toggleNotificationPopup() {
            this.showNotificationPopup = !this.showNotificationPopup;
        },
        async deleteNotifications() {
            try {
                const response = await axios.delete(route('users.delete-user-notifications'));

                if (response.status === 200) {
                    this.notifications = [];
                    this.$notify({
                        title: "Éxito",
                        message: response.data.message,
                        type: "success",
                    });
                }
            } catch (error) {
                console.log(error);
                this.$notify({
                    title: "No se pudo completar la solicitud",
                    message: "El servidor no pudo procesar la petición, inténtalo más tarde",
                    type: "error",
                });
            }
        },
        async fetchNotifications() {
            try {
                const response = await axios.get(route('users.get-notifications'));

                if (response.status === 200) {
                    this.notifications = response.data.items;
                }
            } catch (error) {
                console.log(error);
                this.$notify({
                    title: "No se pudo completar la solicitud",
                    message: "El servidor no pudo procesar la petición para obtener las notificaciones. Inténtalo más tarde",
                    type: "error",
                });
            }
        },
        async readNotifications() {
            try {
                const response = await axios.post(route("users.read-user-notifications"));

                if (response.data.unread) {
                    this.fetchNotifications();
                }
            } catch (error) {
                console.log(error);
            }
        },
    },
    computed: {
        getUnreadMessages() {
            return this.notifications?.filter(item => item.read_at === null);
        }
    },
    mounted() {
        this.fetchNotifications();
    },

};
</script>