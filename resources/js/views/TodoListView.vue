<template>
     <section class="todoapp">
            <header class="header col-12 mb-2 d-flex justify-content-between">
              <h1>Todo List</h1>
              <span><button type='button' class='btn btn-primary' @click="showOrClose(0, 'modalStoreTodo')">Add a Todo Task</button></span>
            </header>
            <div class='col-lg-12'>
                <SimpleModalComponent ref="modalStoreTodo" :refProp="'modalStoreTodo'" :heightProp="'60%'" :widthProp="'80%'">
                    <storeUpdateTodoList ref='simpleStoreUpdateTodoList' @callParentMethod="storeUpdateTodoList" :errors='this.errors' :todoProp="this.todoList.todo">Add a Todo List</storeUpdateTodoList>
                </SimpleModalComponent>
            </div>
            <div class='col-lg-12'>
                <todoList :todoListProp="this.todoList.items" @callParentMethod="deleteTodoList" @callPopulateParentMethod="populateTodoToEdit"></todoList>
            </div>
     </section>
 </template>
 <script>

import axiosPostMixin       from '../mixins/axiosPostMixin.js';
import axiosGetMixin        from '../mixins/axiosGetMixin.js';
import axiosDeleteMixin     from '../mixins/axiosDeleteMixin.js';
import axiosPutMixin        from '../mixins/axiosPutMixin.js';
import helperMixin          from '../mixins/helperMixin.js';
import validationMixin      from '../mixins/validationMixin.js';

import SimpleModalComponent from '../components/ui/SimpleModalComponent.vue';

import storeUpdateTodoList        from "../components/forms/StoreUpdateTodoListComponent.vue";
import todoList             from "../components/forms/TodoListComponent.vue";

export default {
  mixins: [axiosPostMixin, axiosGetMixin, axiosDeleteMixin, axiosPutMixin, helperMixin, validationMixin],
  components: {
   SimpleModalComponent,
   storeUpdateTodoList,
   todoList
  },
  name: "TodoApp",
  mounted() {
    this.showTodoList();

    window.Echo.channel("deleteDataTodoList").listen(".delete-todo-list", e => {
        this.todoList.items.splice(this.todoList.items.findIndex(obj => obj.id == e.dataTasks.id), 1);
    });

    window.Echo.channel("updateDataTodoList").listen(".update-todo-list", e => {
        let item            = this.todoList.items[this.todoList.items.findIndex(obj => obj.id == e.dataTasks.id)];
        item.title          = e.dataTasks.title;
        item.description    = e.dataTasks.description;
        
        this.$refs['simpleStoreUpdateTodoList'].clear();
        this.showOrClose(1, 'modalStoreTodo');
    });

    window.Echo.channel("storeDataTodoList").listen(".store-todo-list", e => {
      this.todoList.items.push(e.dataTasks);
      this.$refs['simpleStoreUpdateTodoList'].clear();
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
              todo: '',
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
    storeUpdateTodoList(form) {
        this.errors             = [];
        this.params             = [];

        this.params['url']      = '/api/internalApi-Todo-List';

        if(form.id != '') {
            this.params['url'] = this.params['url']+'/'+form.id;
            this.axiosPutNormal(this.params, form);
        }
        else
            this.axiosPostNormal(this.params, form);
    },
    deleteTodoList(id) {
        this.errors                     = [];
        this.params['url']              = '/api/internalApi-Todo-List/'+id;

        this.axiosDeleteNormal(this.params);
    },
    populateTodoToEdit(todo) {
        this.todoList.todo = todo;
        this.showOrClose(0, 'modalStoreTodo');
    }
  },
};
</script>
