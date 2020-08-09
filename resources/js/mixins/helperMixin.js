let axiosGetMixin = {
    methods: {
        //Show and hide modal
        showOrClose (hide, ref) {
            if(hide)
                this.$refs[ref].hide(ref);
            else
                this.$refs[ref].show(ref);
        },
        //Total Off Groups
        total (objectVariables, functionName) {
            let sum = 0;
            if(objectVariables) {
                for(var item in objectVariables) {
                   if(objectVariables[item][functionName][0])
                    sum += parseFloat(objectVariables[item][functionName][0].amount);
                }
            }

           return sum;
        },
    }
}

export default axiosGetMixin
