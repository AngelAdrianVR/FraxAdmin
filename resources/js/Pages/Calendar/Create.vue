<template>
  <AppLayout title="Agendar en calendario">
    <div class="lg:pt-7 lg:px-10">
      <Back />
      <h1 class="font-bold mx-28 mt-5">Agendar en calendario</h1>
      <form @submit.prevent="store" class="mx-8 mt-3">
        <div class="flex justify-center items-center space-x-12 text-sm mb-10">
          <div class="flex items-center mr-5">
            <input v-model="form.type" value="Evento"
              class="checked:bg-primary focus:text-primary focus:ring-primary bg-transparent w-3 h-3 cursor-pointer"
              type="radio" name="task_type" />
            <p class="ml-3 flex">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                class="bi bi-calendar4-event mr-2 mt-px" viewBox="0 0 16 16">
                <path
                  d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z" />
                <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
              </svg>
              Evento
            </p>
          </div>
          <div class="flex items-center">
            <input v-model="form.type" value="Tarea"
              class="checked:bg-primary focus:text-primary focus:ring-primary bg-transparent w-3 h-3 cursor-pointer"
              type="radio" name="task_type" />
            <p class="ml-3 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-check2-circle mr-2" viewBox="0 0 16 16">
                <path
                  d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                <path
                  d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
              </svg>
              Tarea
            </p>
          </div>
          <InputError :message="form.errors.type" />
        </div>
        <!-- --------------- Evento -------------- -->
        <section class="grid grid-cols-2 gap-x-4 gap-y-2" v-if="form.type == 'Evento'">
          <div>
            <InputLabel value="Título del evento *" class="ml-2" />
            <input v-model="form.title" class="input" type="text" placeholder="Agregar título" />
            <InputError :message="form.errors.title" />
          </div>
          <div>
            <InputLabel value="Participante(s)" class="ml-2" />
            <el-select class="w-full" v-model="form.participants" filterable multiple
              placeholder="Seleccionar participantes" no-data-text="No hay usuarios registrados"
              no-match-text="No se encontraron coincidencias">
              <el-option v-for="user in users" :key="user.id" :label="user.name" :value="user.id">
                <div v-if="$page.props.jetstream.managesProfilePhotos"
                  class="flex text-sm rounded-full items-center mt-[3px]">
                  <img class="h-7 w-7 rounded-full object-cover mr-4" :src="user.profile_photo_url" :alt="user.name" />
                  <p>{{ user.name }}</p>
                </div>
              </el-option>
            </el-select>
            <InputError :message="form.errors.participants" />
          </div>
          <div class="lg:flex items-center">
            <div class="mt-2 lg:mt-0 ">
              <InputLabel value="Fecha *" class="ml-2" />
              <el-date-picker v-model="form.start_date" type="date" placeholder="Fecha *" :disabled-date="disabledDate" />
              <InputError :message="form.errors.start_date" />
            </div>
            <label class="flex items-center mt-1 lg:mt-5 lg:ml-4 text-xs">
              <Checkbox v-model:checked="form.is_full_day" class="bg-transparent disabled:border-gray-400" />
              <span class="ml-2 text-xs">Todo el día</span>
            </label>
          </div>
          <div v-if="!form.is_full_day" class="col-span-full lg:col-span-1">
            <InputLabel value="Horario *" class="ml-2" />
            <el-time-select class="mr-5 mb-3 lg:mb-0" v-model="form.start_time" start="08:00" step="00:30" end="20:30"
              placeholder="Hora de inicio" :max-time="form.end_time" format="hh:mm A" />
            <el-time-select v-model="form.end_time" start="08:00" step="00:30" end="20:30" placeholder="Hora de término"
              :min-time="form.start_time" format="hh:mm A" />
            <!-- <InputError :message="form.errors.time" /> -->
          </div>
          <!-- <div>
              <label class="block">Repetir</label>
              <el-select
                class="w-full mt-2"
                v-model="form.repeater"
                clearable
                placeholder="Seleccionar"
                no-data-text="No hay opciones registradas"
                no-match-text="No se encontraron coincidencias"
              >
                <el-option
                  v-for="repeater in repeaters"
                  :key="repeater"
                  :label="repeater"
                  :value="repeater"
                />
              </el-select>
              <InputError :message="form.errors.repeater" />
            </div> -->
          <div class="col-span-full lg:col-span-1">
            <InputLabel value="Ubicación" class="ml-2" />
            <input v-model="form.location" class="input" type="text" placeholder="Agregar ubicación" />
            <InputError :message="form.errors.location" />
          </div>
          <div class="col-span-full">
            <InputLabel value="Descripción" class="ml-2" />
            <textarea v-model="form.description" class="input h-24"> </textarea>
            <InputError :message="form.errors.description" />
          </div>
          <!-- <div>
              <label class="block">Recordatorio</label>
              <div class="flex items-center">
                <el-select
                  class="w-1/2 mt-2"
                  v-model="form.reminder"
                  clearable
                  placeholder="Seleccionar"
                  no-data-text="No hay opciones registradas"
                  no-match-text="No se encontraron coincidencias"
                >
                  <el-option
                    v-for="reminder in reminders"
                    :key="reminder"
                    :label="reminder"
                    :value="reminder"
                  />
                </el-select>
                <p class="text-sm text-primary ml-7 cursor-pointer w-1/2">
                  + Agregar recordatorio
                </p>
              </div>
              <InputError :message="form.errors.reminder" />
            </div> -->
        </section>
  
        <!-- ------------- Tarea .............. -->
        <section class="grid grid-cols-2 gap-x-4 gap-y-2" v-else>
          <div>
            <InputLabel value="Título de la tarea *" class="ml-2" />
            <input v-model="form.title" class="input" type="text" placeholder="Agregar título" />
            <InputError :message="form.errors.title" />
          </div>
          <div class="flex items-center col-span-full">
            <div class="lg:mt-0">
              <InputLabel value="Fecha *" class="ml-2" />
              <el-date-picker v-model="form.start_date" type="date" placeholder="Fecha *" :disabled-date="disabledDate" />
              <InputError :message="form.errors.start_date" />
            </div>
            <label class="flex items-center mt-5 ml-5">
              <Checkbox v-model:checked="form.is_full_day" class="bg-transparent disabled:border-gray-400" />
              <span class="ml-2 text-xs">Todo el día</span>
            </label>
          </div>
          <div v-if="!form.is_full_day">
            <InputLabel value="Horario" class="ml-2" />
            <el-time-select class="mr-5 mb-3 lg:mb-0" v-model="form.start_time" start="08:00" step="00:30" end="20:30"
              placeholder="Hora de inicio" :max-time="form.end_time" format="hh:mm A" />
            <el-time-select v-model="form.end_time" start="08:00" step="00:30" end="20:30" placeholder="Hora de término"
              :min-time="form.start_time" format="hh:mm A" />
            <!-- <div class="demo-range">
                <el-time-picker v-model="form.time" is-range range-separator="-" start-placeholder="Hora inicio"
                  end-placeholder="Hora final" />
              </div>
              <InputError :message="form.errors.time" /> -->
          </div>
          <!-- <div>
              <label class="block">Repetir</label>
              <el-select class="w-full mt-2" v-model="form.repeater"  placeholder="Seleccionar"
                no-data-text="No hay opciones registradas" no-match-text="No se encontraron coincidencias">
                <el-option v-for="repeater in repeaters" :key="repeater" :label="repeater" :value="repeater" />
              </el-select>
              <InputError :message="form.errors.repeater" />
            </div> -->
          <div class="col-span-full">
            <InputLabel value="descripción" class="ml-2" />
            <textarea v-model="form.description" class="input h-24"> </textarea>
            <InputError :message="form.errors.description" />
          </div>
          <!-- <div>
              <label class="block">Recordatorio</label>
              <div class="flex items-center">
                <el-select class="w-1/2 mt-2" v-model="form.reminder"  placeholder="Seleccionar"
                  no-data-text="No hay opciones registradas" no-match-text="No se encontraron coincidencias">
                  <el-option v-for="reminder in reminders" :key="reminder" :label="reminder" :value="reminder" />
                </el-select>
                <p class="text-sm text-primary ml-7 cursor-pointer w-1/2">
                  + Agregar recordatorio
                </p>
              </div>
              <InputError :message="form.errors.reminder" />
            </div> -->
        </section>
  
        <div class="flex md:text-left items-center mt-4">
          <PrimaryButton :disabled="form.processing"> Guardar </PrimaryButton>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import DialogModal from "@/Components/DialogModal.vue";
import CancelButton from "@/Components/MyComponents/CancelButton.vue";
import Back from "@/Components/MyComponents/Back.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Link, useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      type: "Evento",
      title: null,
      participants: [],
      repeater: "No se repite",
      location: null,
      description: null,
      reminder: null,
      is_full_day: false,
      // time: null,
      start_time: null,
      end_time: null,
      start_date: null,
    });
    return {
      form,
      repeaters: [
        "No se repite",
        "Todos los días",
        "Cada semana, el lunes",
        "Personalizado",
      ],
      reminders: [
        "5 minutos antes",
        "10 minutos antes",
        "1 hora antes",
        "1 día antes",
        "Personalizado",
      ],
    }
  },
  components: {
    AppLayout,
    PrimaryButton,
    InputLabel,
    InputError,
    DialogModal,
    CancelButton,
    Checkbox,
    Link,
    Back,
  },
  props: {
    users: Array,
  },
  methods: {
    store() {
      this.form.post(route("calendars.store"), {
        onSuccess: () => {
          this.$notify({
            title: "Correcto",
            message: "Se ha agendado a tu calendario",
            type: "success",
          });
        },
      });
    },
    disabledDate(time) {
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      return time.getTime() < today.getTime();
    },
  }
}
</script>
