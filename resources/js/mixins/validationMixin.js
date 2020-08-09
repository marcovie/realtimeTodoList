let validationMixin = {
    methods: {
      validate(form, formRules) {
          let errorFound = false;
          for (var formVariable in form) {
              if(formRules[formVariable+'Rule'] && form[formVariable] != 'disabled')
              {
                  if(formRules[formVariable+'Rule']['ruleToValidate']) {
                      let rulesList = formRules[formVariable+'Rule']['ruleToValidate'].split('|');
                      let tmpErrorFound = false;
                      rulesList.forEach((rule, index) => {
                          let tmpRule = (rule.includes(':'))?rule.split(':')[0]:rule;
                          if(!tmpErrorFound) {
                              switch(tmpRule) {
                                  case 'required' :
                                                if(form[formVariable] && form[formVariable].trim() != '' && form[formVariable] != undefined && form[formVariable] != null)
                                                {
                                                    formRules[formVariable+'Rule']['errorMessage'] = '';
                                                    tmpErrorFound = false;
                                                }
                                                else
                                                {
                                                    formRules[formVariable+'Rule']['errorMessage'] = 'This field is required, please enter a value.';
                                                    tmpErrorFound = true;
                                                }
                                                break;
                                  case 'min' :
                                              let tmpMinVal = rule.split(':')[1];
                                              if(form[formVariable].length >= tmpMinVal)
                                              {
                                                  formRules[formVariable+'Rule']['errorMessage'] = '';
                                                  tmpErrorFound = false;
                                              }
                                              else
                                              {
                                                  formRules[formVariable+'Rule']['errorMessage'] = 'This field must be bigger than '+(tmpMinVal-1)+' characters.';
                                                  tmpErrorFound = true;
                                              }
                                              break;
                              }

                              if(tmpErrorFound)
                              {
                                  errorFound = true;
                              }
                          }
                      });
                  }
                  else {
                      console.log('Incorrect object format for validation');
                  }
              }
          }
          return !errorFound;
      },
      resetData(data) {
          for (var innerData in data) {
              if(Array.isArray(data[innerData])) {
                  data[innerData] = [];
              }
              else if(typeof data[innerData] === 'object' && data[innerData] !== null) {
                  this.resetData(data[innerData]);
              }
              else {
                  data[innerData] = '';
              }
          }
      }
    }
}

export default validationMixin
