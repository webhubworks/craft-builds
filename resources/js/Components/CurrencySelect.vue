<template>
    <div>

        <t-dropdown :classes="{
            button: 'block px-4 py-2 text-gray-700 transition duration-100 ease-in-out bg-white border border-gray-100 rounded shadow-sm hover:bg-gray-100 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed',
            wrapper: 'inline-flex flex-col',
            dropdownWrapper: 'relative z-10',
            dropdown: 'origin-top-left absolute right-0 w-56 rounded shadow bg-white mt-1',
            enterClass: 'opacity-0 scale-95',
            enterActiveClass: 'transition transform ease-out duration-100',
            enterToClass: 'opacity-100 scale-100',
            leaveClass: 'opacity-100 scale-100',
            leaveActiveClass: 'transition transform ease-in duration-75',
            leaveToClass: 'opacity-0 scale-95',
        }" :text="selectedCurrency">
            <div class="py-1 rounded-md shadow-xs" slot-scope="{ hide, blurHandler }">
                <button
                    v-for="currency in currencies"
                    @click.prevent="onChange(currency)"
                    @blur="blurHandler"
                    class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:pointer-events-none"
                    :class="{'bg-gray-50': selectedCurrency === currency}"
                    role="menuitem"
                    :disabled="selectedCurrency === currency"
                >
                    <span class="flex items-center">
                        <img class="h-4 mr-2" :src="`/currencies/${currency.toLowerCase()}.png`" :alt="currency">
                        {{ currency }}
                    </span>
                </button>
            </div>
        </t-dropdown>

    </div>
</template>

<script>
export default {
    computed: {
        currencies() {
            return this.$page.props.currencies;
        },
    },

    props: {
        selectedCurrency: String,
    },

    data() {
        return {
            modalOpen: true,
        }
    },

    methods: {
        onChange(currency) {
            this.$emit('change', currency);
        }
    }
}
</script>
