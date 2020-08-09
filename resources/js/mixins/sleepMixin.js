let sleepMixin = {
    methods: {
      sleep(milliseconds) {
        return new Promise(resolve => setTimeout(resolve, milliseconds));
      },
    }
}

export default sleepMixin
