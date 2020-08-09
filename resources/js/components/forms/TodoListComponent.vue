<template>
   <div class="container">
       <ul class="list-group mt-4" v-for="(todo, index) in todoListProp">
        <li class="list-group-item list-group-item-primary row d-flex">
          <div class='col-lg-12 d-flex flex-wrap justify-content-between'>
            <span class='mt-2'><b>Title: </b>{{ todo.title }}</span>
          </div>
        </li>
        <li class="list-group-item row d-flex">
          <div class='col-lg-12 d-flex flex-wrap justify-content-between'>
            <span>{{todo.description}}</span><span><button type='button' class='btn btn-primary' @click="editTodoList(todo)"><i class="far fa-edit"></i> Edit</button>&nbsp;<button type='button' class='btn btn-primary' @click="deleteTodoList(todo.id)"><i class="far fa-check-square"></i> Complete</button></span>
          </div>
        </li>
      </ul>
   </div>
</template>

<script>

export default {
        mixins: [],
        components: {

        },
        props: ['todoListProp'],
        name: "TodoList",
        mounted() {

        },
        methods: {
            deleteTodoList(id) {
                this.$emit('callParentMethod', id);
            },
            editTodoList(todo) {
                this.$emit('callPopulateParentMethod', todo);
            }
        }
    };
</script>
