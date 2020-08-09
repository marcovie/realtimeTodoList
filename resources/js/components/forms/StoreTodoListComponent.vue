<template>
    <div class="row">
        <div class="col-12">
            <div class="cardHeaderSimple">
                <slot><!-- Heading --></slot>
            </div>
            <div class="justify-content-center">
                   <div class='col-lg-12'>
                       <input class="editInputSimple" type="input" placeholder="Enter a Title" v-model="form.title" required @keyup.enter="storeTodoList"/>
                       <p v-if='formRules.titleRule.errorMessage'>
                           <small><span class="text-danger" v-text="formRules.titleRule.errorMessage"></span></small>
                       </p>
                   </div>
                   <div class='col-lg-12'>
                       <textarea class="editInputSimple" type="input" placeholder="Enter a Description" v-model="form.description" required @keyup.enter="storeTodoList"/>
                       <p v-if='formRules.descriptionRule.errorMessage'>
                           <small><span class="text-danger" v-text="formRules.descriptionRule.errorMessage"></span></small>
                       </p>
                   </div>
                   <div class='col-12 d-flex flex-row-reverse mt-5'>
                       <button type='button' class='btn btn-primary' @click="submitToParent()">Submit</button>
                   </div>
             </div>
          </div>
     </div>
</template>
<script>
import validationMixin from '../../mixins/validationMixin.js';

export default {
  name: "storeTodo",
  mixins: [validationMixin],
  data() {
      return {
          formRules: {
              titleRule: {
                  ruleToValidate: 'required|min:3',
                  errorMessage: '',
              },
              descriptionRule: {
                  ruleToValidate: 'required|min:3',
                  errorMessage: '',
              }
          },
          form: {
                title: '',
                description: '',
            },
          valid: true,
      }
    },
  mounted() {

  },
  methods: {
    submitToParent () {
      if(this.validatingForm())
      {
          this.$emit('callParentMethod', this.form);
      }
    },
    validatingForm () {
      return this.validate(this.form, this.formRules);
    },
    clear() {
        this.resetData(this.form);
    },
  },
};
</script>
