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
        }">
            <div
                slot="trigger"
                slot-scope="{
      mousedownHandler,
      focusHandler,
      blurHandler,
      keydownHandler,
      isShown
    }"
            >
                <button
                    id="user-menu"
                    class="print:hidden flex items-center p-2 text-sm text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-200 rounded-md focus:outline-none focus:shadow-solid"
                    aria-label="User menu"
                    aria-haspopup="true"
                    @mousedown="mousedownHandler"
                    @focus="focusHandler"
                    @blur="blurHandler"
                    @keydown="keydownHandler"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                </button>
            </div>
            <div class="py-1 rounded-md shadow-xs" slot-scope="{ hide, blurHandler }">
                <button
                    class="block w-full px-4 py-2 leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100 text-left"
                    @click.prevent="currencyModalOpen = true" @mouseup="blurHandler">Change currency
                </button>
                <button
                    class="block w-full px-4 py-2 leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100 text-left"
                    @click.prevent="localeModalOpen = true" @mouseup="blurHandler">Change locale
                </button>
            </div>
        </t-dropdown>

        <t-modal header="Share" :value="shareModalOpen">

        </t-modal>

        <t-modal header="Select currency" :value="currencyModalOpen">
            <button
                v-for="currency in currencies"
                @click.prevent="onCurrencyChange(currency)"
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
        </t-modal>

        <t-modal header="Select locale" :value="localeModalOpen">
            <button
                v-for="locale in Object.keys(locales)"
                @click.prevent="onLocaleChange(locale)"
                class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:pointer-events-none"
                :class="{'bg-gray-50': selectedLocale === locale}"
                role="menuitem"
                :disabled="selectedLocale === locale"
            >
                <span class="flex items-center">
                    {{ locales[locale].native }}
                </span>
            </button>
        </t-modal>

    </div>
</template>

<script>
export default {
    computed: {
        locales() {
            return this.$page.props.locales;
        },
        selectedLocale() {
            return this.$page.props.selectedLocale;
        },
        currencies() {
            return this.$page.props.currencies;
        },
        selectedCurrency() {
            return this.$page.props.selectedCurrency;
        },
    },

    data() {
        return {
            shareModalOpen: false,
            currencyModalOpen: false,
            localeModalOpen: false,
        }
    },

    methods: {
        onCurrencyChange(currency) {
            this.$emit('currency-change', currency);
            this.currencyModalOpen = false;
        },
        onLocaleChange(locale) {
            this.$emit('locale-change', locale);
            this.localeModalOpen = false;
        },
    }
}
</script>
