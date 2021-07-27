<template>
    <div>
        <div class="flex w-full">
            <div class="flex-shrink-0">
                <img
                    class="w-10 h-10"
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

        <div class="min-w-[235px]">
            <label :for="`${plugin.handle}-edition`" class="font-semibold text-sm text-gray-500">Edition</label>

            <div v-if="plugin.editions.length < 2">
                {{ plugin.editions.find(edition => edition.id == plugin.pivot.edition_id).name }}
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
                    <div class="group">
                        {{ option.text }} <span class="text-blue-500 text-xs group-hover:inline-block hidden hover:underline">Change</span>
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
                                    {{
                                option.raw.price ? `${option.raw.price} + ${option.raw.renewal_price}/year` : 'free'
                            }}
                                </span>
                    </div>

                </template>
            </t-rich-select>
        </div>

        <div class="min-w-[50px] flex justify-center">
            <t-button @click.prevent="$emit('remove', plugin.handle)"
                      title="Remove plugin from configuration"
                      class="text-2xl w-full text-gray-400 group-hover:block hidden"
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
    }
}
</script>
