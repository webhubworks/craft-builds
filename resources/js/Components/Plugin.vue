<template>
    <div class="lg:flex justify-between lg:space-x-4">

        <div class="w-full lg:w-4/5">
            <div class="flex w-full mb-4 sm:mb-0">
                <div class="flex-shrink-0">
                    <img
                        class="w-12 h-12 xl:w-16 xl:h-16"
                        :src="plugin.icon_url"
                        :alt="`Logo ${plugin.name}`">
                </div>
                <div class="w-full ml-4 lg:ml-6 text-gray-800">
                    <div class="flex">

                        <div class="w-2/3">
                            <h3 class="text-base lg:text-lg font-bold mt-0">
                                {{ plugin.name }}
                            </h3>
                            <p class="text-sm lg:text-base leading-tight text-gray-700">
                                {{ plugin.short_description }}</p>
                        </div>


                        <div class="w-1/3">

                            <label :for="`${plugin.handle}-edition`"
                                   class="sr-only">Edition</label>

                            <div v-if="plugin.editions.length < 2">
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
                                    <div class="edition-label w-full">
                                        {{ option.text }}
                                        <span
                                            class="edition-label__change text-blue-500 text-xs hidden hover:underline">Change</span>
                                    </div>
                                </template>

                                <template slot="option"
                                          slot-scope="{ index, isHighlighted, isSelected, className, option, query }">
                                    <div class="flex flex-col w-full ml-2 text-gray-800">
                                        <strong>
                                            {{ option.raw.name }}
                                            <span v-if="isSelected">(Selected)</span>
                                        </strong>
                                        <span class="text-sm leading-tight text-gray-700">
                            {{ option.raw.price ? `${option.raw.price} + ${option.raw.renewal_price}/year` : 'free' }}
                        </span>
                                    </div>
                                </template>

                            </t-rich-select>
                        </div>
                    </div>

                    <t-button @click.prevent="$emit('remove', plugin.handle)"
                              title="Remove plugin from configuration"
                              class="inline text-base text-gray-400 block opacity-25 group-hover:opacity-100 "
                              variant="text"
                    >Remove &times;
                    </t-button>
                </div>
            </div>
        </div>

        <div class="ml-8 sm:ml-16 lg:ml-auto lg:w-1/5 flex">

            <div class="whitespace-nowrap ml-auto ">
                <label class="font-semibold text-sm text-gray-500 sr-only">Price</label>
                <div class="w-full block">{{ edition.price ? edition.price : 'free' }}</div>
                <div v-if="edition.renewal_price">{{ `${edition.renewal_price}/year` }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        plugin: Object,
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
.edition-label:hover .edition-label__change {
    display: inline-block;
}
</style>
