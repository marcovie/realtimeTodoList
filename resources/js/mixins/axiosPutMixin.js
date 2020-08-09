let axiosPutNormal = {
    methods: {
      axiosPutNormal(params, objectVariables) {
        axios.put(params.url, objectVariables, {
            headers: { 'Content-Type': 'application/json; charset=UTF-8' }
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
export default axiosPutNormal
