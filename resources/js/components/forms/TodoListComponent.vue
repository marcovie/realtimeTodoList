<template>
   <div>
       <ul class="list-group mt-4" v-for="(todo, index) in todoListProp">
        <li class="list-group-item list-group-item-primary row d-flex">
          <div class='col-12 d-flex justify-content-between'>
            <span class='mt-2'><b>Title: </b>{{ todo.title }}</span>
          </div>
        </li>
        <li class="list-group-item row d-flex">
          <div class='col-12 d-flex justify-content-between'>
            <span>{{todo.description}}</span><span><button type='button' class='btn btn-primary' @click="deleteTodoList(todo.id)">Complete Todo Task</button></span>
          </div>
        </li>
      </ul>
   </div>
</template>

<script>
// import { mapGetters } from "vuex";
// import todo from "../components/Todo";
export default {
        components: {
            // todo
        },
        props: ['todoListProp'],
        name: "TodoList",
        mounted() {
            // this.$store.dispatch("GET_TODOS");
        },
        methods: {
            deleteTodoList(id) {
                this.$emit('callParentMethod', id);
            }
        }
    };
</script>
