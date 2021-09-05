<template>
    <div class="min-h-screen">
        <div class="container xl:max-w-6xl">
            <slot></slot>
        </div>

        <div class="fixed right-[1rem] bottom-[1rem]">
            <t-alert variant="success" :show="!!message.length" :timeout="2000" @hidden="clearMessage">
                {{ message }}
            </t-alert>
        </div>

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
