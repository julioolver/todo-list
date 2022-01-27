<template>
  <v-snackbar
      :color="color"
      :timeout="timer"
      v-model="showSnackbar"
      bottom
      center
  >
    <v-icon left>{{icon}}</v-icon>{{message}}
  </v-snackbar>
</template>

<script>
import message from '@/utils/messages'

export default {
  name: "vtoast",
  data() {
    return{
      showSnackbar: false,
      message: '',
      color: 'success',
      icon: 'mdi-check',
      timer: 3000
    }
  },
  methods:{
    show(data) {
      this.message = message[data.message] || data.message || 'Erro interno.'
      this.color = data.color || 'success'
      this.timer = data.timer || 3000
      this.icon = data.icon || 'mdi-check'
      this.showSnackbar = true
    }
  }
}
</script>