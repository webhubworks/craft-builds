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
                    class="flex items-center p-2 text-sm text-gray-700 transition duration-150 ease-in-out bg-white border-2 border-gray-200 rounded-md focus:outline-none focus:shadow-solid"
                    aria-label="User menu"
                    aria-haspopup="true"
                    @mousedown="mousedownHandler"
                    @focus="focusHandler"
                    @blur="blurHandler"
                    @keydown="keydownHandler"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </button>
            </div>
            <div class="py-1 rounded-md shadow-xs" slot-scope="{ hide, blurHandler }">
                <button
                    class="block w-full px-4 py-2 leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100 text-left border-b"
                    @click.prevent="shareModalOpen = true">Share
                </button>
                <button
                    class="block w-full px-4 py-2 leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100 text-left"
                    @click.prevent="currencyModalOpen = true">Change currency
                </button>
                <button
                    class="block w-full px-4 py-2 leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100 text-left"
                    @click.prevent="localeModalOpen = true">Change locale
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
                    <img class="h-4 mr-2" :src="`/currencies/${locale.toLowerCase()}.png`" :alt="locale">
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
        },
        onLocaleChange(locale) {
            this.$emit('locale-change', locale);
        },
    }
}
</script>
