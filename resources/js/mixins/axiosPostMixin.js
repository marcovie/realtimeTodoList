let axiosPostMixin = {
    methods: {
      axiosPostNormal(params, objectVariables) {

        let formData                                    = new FormData();
        for (var key in objectVariables) {
          if(objectVariables[key] !== '')
          {
            if(Array.isArray(objectVariables[key]))
              formData.append(key, JSON.stringify(objectVariables[key]));
            else
              formData.append(key, objectVariables[key]);
          }
        }

        axios.post(params.url, formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
          }).then(({data}) => {
              if(!data.successful)//Fail -> 0 -> display message
              {
                flash({"message":data.message, "type":"danger"});
              }
              else//success -> 1 -> call back function
              {
                flash({"message":data.message, "type":"success"});
                if(data.functionName && data.functionName != '')
                    this[data.functionName](data);
              }
          })
          .catch(error => {
              flash({"message":error.response.data.message, "type":"danger"});
              if(error != 'Error: Request failed with status code 500')
                this.errors = error.response.data.errors;
           })
      },
    }
}
export default axiosPostMixin
