<template>
  <div class="alert spacing" :class="'alert-'+level" v-show="show">
      {{ body }}
  </div>
</template>

<script>
export default {
    props: ['message', 'type'],
    data() {
        return {
            body: this.message,
            level: 'success',
            show: false
        }
    },
    created() {
        if (this.message) {
            this.flash()
        }
        window.events.$on('flash', data => this.flash(data))
    },
    methods: {
        flash(data) {
            if (data) {
                this.level = data.type;
                this.body  = data.message
            }

            this.show = true;

            setTimeout(() => {
                this.hide()
            }, 4000)
        },
        hide() {
            this.show = false
        }
    }
}
</script>

<style>
.spacing {
    position: fixed;
    right: 25px;
    bottom: 25px;
    z-index: 99999;
}
</style>
