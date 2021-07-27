<template>
    <div class="container mx-auto mt-16">

        <slot></slot>

        <t-alert variant="success" :show="!!message.length" :timeout="2000" @hidden="clearMessage">
            {{ message }}
        </t-alert>

    </div>
</template>

<script>
export default {
    computed: {
        message() {
            return this.$page.props.message || '';
        }
    },

    methods: {
        clearMessage() {
            this.$page.props.message = '';
        }
    }
}
</script>
