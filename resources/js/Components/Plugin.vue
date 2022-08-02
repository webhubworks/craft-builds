<template>
    <div class="md:flex justify-between lg:space-x-4">

        <div class="w-full lg:w-4/5">
            <div class="flex w-full mb-4 sm:mb-0">

                <div class="flex-shrink-0" v-if="plugin.icon_url">
                    <img
                        class="w-12 h-12 xl:w-16 xl:h-16"
                        :src="plugin.icon_url"
                        :alt="`Logo ${plugin.name}`">
                </div>
                <div v-else>
                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                         class="w-12 h-12 xl:w-16 xl:h-16">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M46.7675 3.05176e-05H1.12239C0.502439 3.05176e-05 -3.05176e-05 0.503655 -3.05176e-05 1.12503V46.875C-3.05176e-05 47.4964 0.502439 48 1.12239 48H46.7675C47.3874 48 47.8899 47.4964 47.8899 46.875V1.12503C47.8899 0.503655 47.3874 3.05176e-05 46.7675 3.05176e-05Z"
                              fill="#eee"/>
                    </svg>
                </div>
                <div class="w-full ml-4 lg:ml-6 text-gray-800">

                    <div class="lg:flex">

                        <div class="lg:w-2/3">
                            <h3 class="text-base md:text-lg font-bold mt-0">
                                <span v-if="plugin.handle !== 'cms'" class="inline-flex items-center">
                                    {{ plugin.name }}
                                     <a :href="'//plugins.craftcms.com/' + plugin.handle" target="_blank" class="hidden md:inline-flex">

                                        <IconLabel icon="external" label="Store Page"
                                                   classes="hidden group-hover:inline-flex font-normal print:hidden ml-2 edition-label__change inline text-gray-600 group-hover:text-blue-500 hover:text-black opacity-50 group-hover:opacity-100 border-b border-transparent hover:border-blue-500"
                                                   label-classes=""></IconLabel>
                                    </a>
                                </span>
                                <span v-else>
                                     {{ plugin.name }}
                                     <a href="https://craftcms.com/pricing" target="_blank" class="hidden md:inline-flex">
                                        <IconLabel icon="external" label="craft cms Website"
                                                   classes="hidden group-hover:inline-flex font-normal print:hidden ml-2 edition-label__change inline text-gray-600 group-hover:text-blue-500 hover:text-black opacity-50 group-hover:opacity-100 border-b border-transparent hover:border-blue-500"
                                                   label-classes=""></IconLabel>
                                    </a>


                                </span>

                            </h3>
                            <p class="text-sm md:text-base leading-tight text-black lg:text-gray-700">
                                {{ plugin.short_description }}</p>
                        </div>


                        <div class="lg:w-1/3">
                            <div class="lg:pl-6">


                                <label :for="`${plugin.handle}-edition`"
                                       class="font-semibold text-sm md:text-base text-gray-500 sr-only"
                                >Edition</label>

                                <div v-if="plugin.editions.length < 2" class="text-sm md:text-base">
                                    {{ edition.name }}
                                </div>

                                <t-rich-select :options="plugin.editions"
                                               v-if="plugin.editions.length > 1"
                                               variant="minimal"
                                               :id="`${plugin.handle}-edition`"
                                               value-attribute="id"
                                               text-attribute="name"
                                               @change="onEditionSet"
                                               :value="plugin.pivot.edition_id"
                                               :hide-search-box="true">

                                    <template slot="arrow"><span></span></template>

                                    <template slot="label" slot-scope="{ className, option, query }">
                                        <div class="w-full inline-flex items-center text-sm md:text-base">
                                            {{ option.text }}
                                            <IconLabel icon="edit" label="Change"
                                                       classes="print:hidden ml-4 edition-label__change inline text-gray-600 group-hover:text-blue-500 hover:text-black opacity-50 group-hover:opacity-100 border-b border-transparent hover:border-blue-500"></IconLabel>
                                        </div>
                                    </template>

                                    <template slot="option"
                                              slot-scope="{ index, isHighlighted, isSelected, className, option, query }">
                                        <div class="flex flex-col w-full p-3">
                                            <strong>
                                                {{ option.raw.name }}
                                                <span v-if="isSelected">(Selected)</span>
                                            </strong>
                                            <span class="text-sm leading-tight">
                                                {{
                                                    option.raw.price ? `${option.raw.price} + ${option.raw.renewal_price}/year` : 'free'
                                                }}
                                            </span>
                                        </div>
                                    </template>

                                </t-rich-select>
                            </div>
                        </div>
                    </div>

                    <t-button @click.prevent="$emit('remove', plugin.handle)"
                              title="Remove plugin from configuration"
                              class="mt-6 lg:mt-0 rounded-none inline text-gray-600 group-hover:text-red-500 block opacity-50 group-hover:opacity-100 hover:text-black border-b-transparent hover:border-b-red-500 hover:no-underline print:hidden"
                              variant="text"
                    >
                        <IconLabel icon="remove" label="Remove"></IconLabel>
                    </t-button>
                </div>
            </div>
        </div>

        <div class="ml-16 lg:ml-none lg:w-1/5 flex">

            <div class="whitespace-nowrap md:ml-auto md:text-right text-sm md:text-base">
                <label class="font-semibold text-sm text-gray-500 sr-only">Price</label>
                <div class="w-full block md:mb-1 font-bold">{{ edition.price ? edition.price : 'free' }}</div>
                <div v-if="edition.renewal_price">{{ `${edition.renewal_price}/year` }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import IconLabel from "./IconLabel";

export default {
    components: {IconLabel},
    props: {
        plugin: Object,
        index: null
    },

    methods: {
        onEditionSet(editionId) {
            this.$emit('set-edition', this.plugin.handle, editionId);
        }
    },

    computed: {
        edition() {
            return this.plugin.editions.find(edition => {
                return edition.id.toString() === this.plugin.pivot.edition_id.toString();
            });
        }
    }
}
</script>

<style scoped>

</style>
