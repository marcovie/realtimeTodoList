import axios from 'axios'

let axiosDleteMixin = {
    methods: {
      axiosDeleteNormal(params) {
        axios.delete(params.url).then((data) => {
            console.log(data);
            if(data.data.message && data.data.message != '')
              flash({"message":data.data.message, "type":"success"});
          })
          .catch(error => {
              console.log(error);
              this.errors = "An error occured while trying to delete, please try again.";
           })
      },
    }
}

export default axiosDleteMixin
