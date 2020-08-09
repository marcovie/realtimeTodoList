<template>
     <section class="todoapp">
            <header class="header col-12 mb-2 d-flex justify-content-between">
              <h1>Todo List</h1>
              <span><button type='button' class='btn btn-primary' @click="showOrClose(0, 'modalStoreTodo')">Add a Todo Task</button></span>
            </header>
            <div class='col-lg-12'>
                <SimpleModalComponent ref="modalStoreTodo" :refProp="'modalStoreTodo'" :heightProp="'60%'" :widthProp="'80%'">
                    <storeTodoList ref='simpleStoreTodoList' @callParentMethod="storeTodoList" :errors='this.errors'>Add a Todo List</storeTodoList>
                </SimpleModalComponent>
            </div>
            <div class='col-lg-12'>
                <todoList :todoListProp="this.todoList.items" @callParentMethod="deleteTodoList"></todoList>
            </div>
     </section>
 </template>
 <script>

import axiosPostMixin       from '../mixins/axiosPostMixin.js';
import axiosGetMixin        from '../mixins/axiosGetMixin.js';
import axiosDeleteMixin     from '../mixins/axiosDeleteMixin.js';
import helperMixin          from '../mixins/helperMixin.js';
import validationMixin      from '../mixins/validationMixin.js';

import SimpleModalComponent from '../components/ui/SimpleModalComponent.vue';

import storeTodoList        from "../components/forms/StoreTodoListComponent.vue";
import todoList             from "../components/forms/TodoListComponent.vue";

export default {
  mixins: [axiosPostMixin, axiosGetMixin, axiosDeleteMixin, helperMixin, validationMixin],
  components: {
   SimpleModalComponent,
   storeTodoList,
   todoList
  },
  name: "TodoApp",
  mounted() {
    this.showTodoList();

    window.Echo.channel("deleteDataTodoList").listen(".delete-todo-list", e => {
        this.todoList.items.splice(this.todoList.items.indexOf(e.dataTasks), 1);
    });

    window.Echo.channel("storeDataTodoList").listen(".store-todo-list", e => {
      this.todoList.items.push(e.dataTasks);
      this.$refs['simpleStoreTodoList'].clear();
      this.showOrClose(1, 'modalStoreTodo');
    });
  },
  data() {
      return {
          errors: [],
          params: [],
          todoList:
          {
              items: [],
              definitions: [],
          },
      }
    },
  methods: {
    showTodoList() {
        this.errors             = [];
        this.params             = [];

        this.resetData(this.todoList);

        this.params['url']      = '/api/internalApi-Todo-List';

        this.axiosGetNormal(this.params, this.todoList);
    },
    storeTodoList(form) {
        this.errors             = [];
        this.params             = [];

        this.params['url']      = '/api/internalApi-Todo-List';

        this.axiosPostNormal(this.params, form);
    },
    deleteTodoList(id) {
        this.errors                     = [];
        this.params['url']              = '/api/internalApi-Todo-List/'+id;

        this.axiosDeleteNormal(this.params);
    },
  },
};
</script>
