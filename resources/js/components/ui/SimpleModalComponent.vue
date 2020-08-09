<template>
    <div class="container">
        <modal :name="refProp" :height="heightProp"  :width="widthProp">
            <slot>

            </slot>
        </modal>
    </div>
</template>

<script>
    export default {
        mixins: [],
        components: {

        },
        props: ['refProp', 'heightProp', 'widthProp'],
        data() {
          return {

          }
        },
        mounted() {

        },
        methods : {
            show (ref) {
                this.$modal.show(ref);
            },
            hide (ref) {
                this.$modal.hide(ref);
            }
        }
    }
</script>
