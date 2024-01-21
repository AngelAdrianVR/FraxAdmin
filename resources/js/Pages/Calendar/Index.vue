<template>
  <AppLayout title="Calendario">
    <div class="relative overflow-hidden lg:py-7 lg:px-10">
      <div class="flex justify-between text-lg mx-2 lg:mx-14 mt-2">
        <span>Calendario</span>
      </div>

      <div class="flex justify-between text-lg mx-2 lg:mx-14">
        <!-- <span class="text-primary text-sm cursor-pointer">Mes <i class="fa-solid fa-angle-down text-xs ml-2"></i></span> -->
        <span></span>
        <div class="flex justify-between items-center lg:w-1/5">
          <i @click="changeMonth(-1)" class="fa-solid fa-angle-left text-primary text-xs mr-5 cursor-pointer p-1"></i>
          <i class="fa-solid fa-calendar-days text-primary text-sm mr-2"></i>
          <p class="text-[#cccccc]">|</p>
          <p class="text-sm ml-2 uppercase">{{ currentMonth.toLocaleDateString('es-ES', {
            month: 'long', year: 'numeric'
          })
          }}</p>
          <i @click="changeMonth(1)" class="fa-solid fa-angle-right text-primary text-xs ml-5 cursor-pointer p-1"></i>
        </div>
        <div class="flex space-x-2">
          <Link :href="route('calendars.create')">
          <PrimaryButton>Agendar</PrimaryButton>
          </Link>
        </div>
      </div>
      <!-- <div class="mx-14">
        <button @click="showPendentInvitationsModal = true" v-if="pendent_invitations.length"
          class="bg-[#FEDBBD] text-[#FD8827] px-2 py-1 rounded-[5px] text-sm">Invitaciones pendientes <span
            class="ml-2">({{
              pendent_invitations.length }})</span></button>
      </div> -->
      <!-- -------------- calendar section --------------- -->
      <section @click="selectedDay = null" class="w-11/12 mx-auto mb-24 min-h-screen">
        <table class="w-full mt-8">
          <tr class="text-center text-xs">
            <th class="py-2 w-[14.28%] border border-[#9A9A9A]">DOM</th>
            <th class="py-2 w-[14.28%] border border-[#9A9A9A]">LUN</th>
            <th class="py-2 w-[14.28%] border border-[#9A9A9A]">MAR</th>
            <th class="py-2 w-[14.28%] border border-[#9A9A9A]">MIE</th>
            <th class="py-2 w-[14.28%] border border-[#9A9A9A]">JUE</th>
            <th class="py-2 w-[14.28%] border border-[#9A9A9A]">VIE</th>
            <th class="py-2 w-[14.28%] border border-[#9A9A9A]">SAB</th>
          </tr>
          <tr v-for="(week, index) in weeks" :key="index" class="text-xs text-right">
            <td v-for="day in week" :key="day" class="h-32 pb-4 border border-[#9A9A9A] relative">
              <p class="absolute bottom-0 right-3">{{ day }}</p>
              <!-- Agregar línea para tareas y eventos -->
              <div v-for="task in tasks.data" :key="task.id">
                <div class="" v-if="isTaskDay(task, day)">
                  <div @click.stop="selectedTask = task; selectedDay = day"
                    :class="task.status == 'Terminada' ? 'bg-[#AFFD82] border-[#37951F]' : 'bg-primarylight'"
                    class="border-primary border-l-4 border h-5 rounded-sm my-1 text-xs justify-between px-1 items-center cursor-pointer flex relative">
                    <p class="text-start w-5/6 truncate">
                      {{ task.title }}
                    </p>
                    <div>
                      <svg v-if="task.type == 'Evento'" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                        fill="currentColor" class="bi bi-calendar4-event" viewBox="0 0 16 16">
                        <path
                          d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z" />
                        <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                      </svg>
                      <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check2-circle" viewBox="0 0 16 16">
                        <path
                          d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                        <path
                          d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                      </svg>
                    </div>
                    <div v-if="selectedTask === task && selectedDay == day" style="z-index: 999;"
                      class="px-1 pb-3 absolute -bottom-56 w-56 h-auto bg-white rounded-md border cursor-default shadow-lg">
                      <!-- --- Head --- -->
                      <div class="flex items-center justify-end">
                        <p class="border rounded-md py-[1px] px-[2px] bg-primarylight border-primary flex">
                          {{ selectedTask.type }}
                        <div class="ml-1">
                          <svg v-if="selectedTask.type == 'Evento'" xmlns="http://www.w3.org/2000/svg" width="12"
                            height="12" fill="currentColor" class="bi bi-calendar4-event" viewBox="0 0 16 16">
                            <path
                              d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z" />
                            <path
                              d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                          </svg>
                          <svg v-else xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                            class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path
                              d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path
                              d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                          </svg>
                        </div>
                        </p>
                        <i @click.stop="selectedTask = null; selectedDay = null"
                          class="fa-solid fa-xmark text-xs p-2 ml-4 cursor-pointer"></i>
                      </div>
                      <!-- --- Body --- -->
                      <div class="px-3">
                        <p class="font-bold text-left pb-[2px] pl-1">{{ selectedTask?.title }}</p>
                        <div class="grid grid-cols-2 border-y border-[#9A9A9A] p-1 text-left">
                          <p class="text-[#9A9A9A] text-xs">Hora inicio</p>
                          <p class="text-[#9A9A9A] text-xs">Hora termino</p>
                          <p class="text-xs mb-3">{{ selectedTask?.start_time ?? 'Todo el día' }}</p>
                          <p class="text-xs mb-3">{{ selectedTask?.end_time ?? 'Todo el día' }}</p>
                          <p class="text-[#9A9A9A] text-xs col-span-2">Descripción</p>
                          <p class="text-xs col-span-2">{{ selectedTask?.description ?? 'Sin descripción' }}</p>
                        </div>
                      </div>
                      <!-- --- Footer --- -->
                      <div class="px-4 pt-2 flex justify-between items-center">
                        <el-popconfirm v-if="selectedTask?.status === 'Pendiente'" confirm-button-text="Si"
                          cancel-button-text="No" icon-color="#0355B5" title="Tarea terminada?" @confirm="taskDone">
                          <template #reference>
                            <PrimaryButton class="text-xs h-5">Hecho</PrimaryButton>
                          </template>
                        </el-popconfirm>
                        <el-popconfirm confirm-button-text="Si" cancel-button-text="No" icon-color="#D90537"
                          title="Eliminar tarea?" @confirm="deleteTask">
                          <template #reference>
                            <i class="fa-regular fa-trash-can text-primary cursor-pointer"></i>
                          </template>
                        </el-popconfirm>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </table>
      </section>
    </div>

    <DialogModal :show="showPendentInvitationsModal" @close="showPendentInvitationsModal = false">
      <template #title>
        Invitaciones pendientes
      </template>
      <template #content>
        <div v-for="(meeting, index) in pendent_invitations_local" :key="index"
          class="lg:grid grid-cols-3 px-3 py-2 border-b border-[#a9a9a9]">
          <div>
            <h2 class="font-bold ml-2 mb-3">{{ meeting.title }}</h2>
            <p class="text-sm">Fecha: {{ formatDateDns(meeting.start_date) }} </p>
            <p v-if="!meeting.is_full_day" class="text-sm">Hora: {{ meeting.start_time }} - {{ meeting.end_time }} </p>
            <p class="text-sm">Ubicación: {{ meeting.location }} </p>
          </div>
          <div
            class="grid grid-cols-2 lg:grid-cols-5 border-t-2 border-[#cccccc] pt-2 mt-2 lg:border-none col-span-2 text-sm">
            <p>Anfitrión:</p> <span class="lg:col-span-4 truncate">{{ meeting.user?.name }}</span>
            <p>Descripción:</p> <span class="lg:col-span-4 truncate">{{ meeting.description }}</span>
            <p v-if="meeting.user.id !== $page.props.auth.user.id">Asistenca:</p>
            <span v-if="meeting.user.id !== $page.props.auth.user.id" class="lg:col-span-4 flex space-x-2">
              <div
                v-if="meeting.participants.find(item => item.user_id == $page.props.auth.user.id && item.status == 'Pendiente')">
                <el-popconfirm confirm-button-text="Si" cancel-button-text="No" icon-color="#0355B5" title="¿Continuar?"
                  @confirm="setAttendanceConfirmation('Confirmado', index)">
                  <template #reference>
                    <button
                      class="text-sm text-white bg-[#2CC513] rounded-[10px] py-px px-2 mr-3 disabled:opacity-25 disabled:cursor-not-allowed"
                      :disabled="loading">Aceptar</button>
                  </template>
                </el-popconfirm>
                <el-popconfirm confirm-button-text="Si" cancel-button-text="No" icon-color="#0355B5" title="¿Continuar?"
                  @confirm="setAttendanceConfirmation('Rechazado', index)">
                  <template #reference>
                    <button
                      class="text-sm text-white bg-primary rounded-[10px] py-px px-2 mr-3 disabled:opacity-25 disabled:cursor-not-allowed"
                      :disabled="loading">Rechazar</button>
                  </template>
                </el-popconfirm>
                <i v-if="loading" class="fa-solid fa-spinner fa-spin text-sm text-primary"></i>
              </div>
            </span>
          </div>
        </div>
      </template>
      <template #footer>

      </template>
    </DialogModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import DialogModal from "@/Components/DialogModal.vue";
import axios from 'axios';
import moment from 'moment';
import { format } from 'date-fns';
import { es } from 'date-fns/locale';
import { Link } from "@inertiajs/vue3";

export default {
  data() {
    return {
      currentMonth: new Date(),
      selectedTask: null, // Variable para realizar un seguimiento de la tarea seleccionada
      selectedDay: null, // Seguinmiento del dia seleccionado
      showPendentInvitationsModal: false,
      pendent_invitations_local: this.pendent_invitations,
    }
  },
  components: {
    AppLayout,
    PrimaryButton,
    SecondaryButton,
    Link,
    Dropdown,
    DropdownLink,
    DialogModal,
  },
  props: {
    tasks: Object,
    pendent_invitations: Array,
  },
  methods: {
    async setAttendanceConfirmation(status, index) {
      this.loading = true;
      try {
        const response = await axios.put(route('calendars.set-attendance-confirmation', this.pendent_invitations[index].id), {
          status: status
        });

        if (response.status === 200) {
          this.pendent_invitations_local.splice(index, 1);

          if (response.data.item) {
            this.tasks.data.push(response.data.item);
          }

          this.$notify({
            title: 'Éxito',
            message: 'Se ha cambiado el status de la invitacion a ' + status,
            type: 'success'
          });
        }
      } catch (error) {
        this.$notify({
          title: 'Error',
          message: error.message,
          type: 'error'
        });
      } finally {
        this.loading = false;
      }
    },
    formatDateDns(date) {
      const parsedDate = new Date(date);
      return format(parsedDate, "dd MMM, yyyy", { locale: es }); // Formato personalizado
    },
    async taskDone() {
      try {
        const response = await axios.put(route('calendars.task-done', this.selectedTask));

        if (response.status === 200) {
          this.$notify({
            title: "Éxito",
            message: "Tarea terminada",
            type: "success",
          });
          this.selectedTask.status = 'Terminada';
        }
      } catch (error) {
        console.log(error);
      }


    },
    deleteTask() {
      this.$inertia.delete(route('calendars.destroy', this.selectedTask));
      this.$notify({
        title: "Éxito",
        message: "Tarea terminada",
        type: "success",
      });

      this.selectedTask = null;
    },
    changeMonth(offset) {
      const newMonth = new Date(this.currentMonth.getFullYear(), this.currentMonth.getMonth() + offset, 1);
      this.currentMonth = newMonth;
    },
    isTaskDay(task, day) {
      if (day) {
        const taskStartDate = new Date(task.start_date);
        const currentDay = new Date(this.currentMonth.getFullYear(), this.currentMonth.getMonth(), day);

        // Convierte las fechas a objetos Moment
        const momentFecha1 = moment(taskStartDate);
        const momentFecha2 = moment(currentDay);

        return momentFecha1.isSame(momentFecha2);
      }
      return false;
    },
    getDurationTask() {
      // Convierte las fechas en objetos Date
      const startDate = new Date(this.selectedTask.start_date);
      const finishDate = new Date(this.selectedTask.finish_date);

      // Calcula la diferencia en milisegundos
      const diferenciaEnMilisegundos = finishDate - startDate;

      // Convierte la diferencia en días
      const duracionEnDias = diferenciaEnMilisegundos / (1000 * 60 * 60 * 24);

      return duracionEnDias;
    },
    formatDate(dateString) {
      if (dateString) {
        const date = new Date(dateString);
        const options = {
          hour: 'numeric',
          minute: 'numeric',
          hour12: true, // Habilitar el formato AM/PM
        };
        return date.toLocaleTimeString(undefined, options);
      }
      return ''; // Manejar el caso en el que la fecha sea nula
    }
  },
  computed: {
    weeks() {
      const firstDayOfMonth = new Date(this.currentMonth.getFullYear(), this.currentMonth.getMonth(), 1);
      const lastDayOfMonth = new Date(this.currentMonth.getFullYear(), this.currentMonth.getMonth() + 1, 0);
      const startDayOfWeek = firstDayOfMonth.getDay(); // 0 (Domingo) a 6 (Sábado)
      const totalDaysInMonth = lastDayOfMonth.getDate();
      const days = [];
      let currentWeek = [];

      // Llena los días previos al primer día del mes con celdas vacías
      for (let i = 0; i < startDayOfWeek; i++) {
        currentWeek.push('');
      }

      // Agrega los números de los días del mes
      for (let i = 1; i <= totalDaysInMonth; i++) {
        currentWeek.push(i);
        if (currentWeek.length === 7) {
          days.push([...currentWeek]);
          currentWeek = [];
        }
      }

      // Añade la última semana si es necesario
      if (currentWeek.length > 0) {
        days.push([...currentWeek]);
      }

      return days;
    },
  },
}
</script>
