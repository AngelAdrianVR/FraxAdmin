<template>
  <div class="text-secondary font-bold text-xs border rounded-tl-[5px] rounded-bl-[5px]">
    <div class="flex space-x-3 rounded-tl-[5px] rounded-bl-[5px] cursor-pointer p-2 items-start bg-gray-200"
      @click="toggleNotification">
      <!-- <p v-if="showNotification" class="ml-3">{{ buttonText }}</p> -->
      <div class="rounded-full border-2 border-secondary w-4 h-4 flex items-center justify-center">
        <i :class="iconClass" class="mt-[2px] text-[7px] px-1"></i>
      </div>
      <p v-if="showNotification">
        <slot />
      </p>
    </div>
    <!-- <transition name="fade">
      <div v-if="showNotification" class="notification-content">
        <p class="font-bold">{{ notificationTitle }}</p>
      </div>
    </transition> -->
  </div>
</template>

<script>
export default {
  props: {
    // buttonText: {
    //   type: String,
    //   default: 'Click me',
    // },
    iconClass: {
      type: String,
      default: 'fa-solid fa-info',
    },
    // notificationTitle: {
    //   type: String,
    //   default: 'Notification Title',
    // },
    // notificationText: {
    //   type: String,
    //   default: 'Notification text goes here.',
    // },
  },
  data() {
    return {
      showNotification: false,
    };
  },
  methods: {
    toggleNotification() {
      this.showNotification = !this.showNotification;
    },
  },
};
</script>

<style scoped>
.notification-tab {
  cursor: pointer;
  display: flex;
  align-items: center;
  background-color: #C9FDE4;
  padding: 10px;
  border-top-left-radius: 10px;
  /* Redondeo en la esquina superior izquierda */
  border-bottom-left-radius: 10px;
  /* Redondeo en la esquina inferior izquierda */
}

.notification-content {
  background-color: #C9FDE4;
  border-top-left-radius: 3px;
  /* Redondeo en la esquina superior izquierda */
  border-bottom-left-radius: 3px;
  /* Redondeo en la esquina inferior izquierda */
  padding: 10px;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to

/* .fade-leave-active in <2.1.8 */
  {
  opacity: 0;
}

.fade-enter,
.fade-enter-active {
  opacity: 1;
}</style>
