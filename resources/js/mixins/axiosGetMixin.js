let helperMixin = {
    methods: {
      axiosGetNormal(params, object) {
        axios.get(params.url, {
            params: {
              params,
            }
          }).then(({data}) => {
              if(!data.successful)//Fail -> 0 -> display message
              {
                flash({"message":data.message, "type":"danger"});
              }
              else//success -> 1 -> display message -> populate data items
              {
                  if(data.message && data.message != '')
                    flash({"message":data.message, "type":"success"});

                  if(data.definitions)
                    object.definitions = data.definitions;

                  if(data.data)
                    $.each(data.data, function(key, value) {
                        object.items.push(value);
                    });

                  if(data.functionName && data.functionName != '')
                    this[data.functionName]();
              }
          })
          .catch(error => {
              console.log(error);
            flash({"message":error.response.data.message, "type":"danger"});
            if(error != 'Error: Request failed with status code 500')
              this.errors = error.response.data.errors;
           })
      },
    }
}

export default helperMixin
