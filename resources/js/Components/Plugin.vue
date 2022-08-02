<template>
    <div class="lg:flex justify-between lg:space-x-4">

        <div class="w-full lg:w-1/2 xl:w-1/3">
            <div class="flex w-full">
            <div class="flex-shrink-0">
                <img
                    class="w-12 h-12"
                    :src="plugin.icon_url"
                    :alt="`Logo ${plugin.name}`">
            </div>
            <div class="flex flex-col w-full ml-4 text-gray-800">
                <strong>
                    {{ plugin.name }}
                </strong>
                <span class="text-sm leading-tight text-gray-700">{{ plugin.short_description }}</span>
            </div>
        </div>
        </div>

        <div class="ml-16 lg:ml-0 lg:w-1/2 xl:w-1/3">

            <div class="flex justify-between">

                <div class="w-full md:w-1/2">

                    <label :for="`${plugin.handle}-edition`"
                           class="font-semibold text-sm text-gray-500">Edition</label>

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
                                <span class="edition-label__change text-blue-500 text-xs hidden hover:underline">
                            Change
                        </span>
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


                <div class="w-full md:w-1/2">
                    <label class="font-semibold text-sm text-gray-500">Price</label>
                    <div class="whitespace-nowrap">
                        {{ edition.price ? `${edition.price} + ${edition.renewal_price}/year` : 'free' }}
                    </div>
                </div>


            </div>
        </div>
        <div class="flex justify-center">
            <t-button @click.prevent="$emit('remove', plugin.handle)"
                      title="Remove plugin from build"
                      class="text-2xl w-full text-gray-400 block opacity-25 group-hover:opacity-100 "
                      variant="secondary"
            >&times;
            </t-button>
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
