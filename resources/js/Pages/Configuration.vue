<template>
    <Base>

        <div class="bg-white p-8">

            <h1 class="mb-16 text-3xl font-semibold">New configuration</h1>

            <div v-if="configuration">
                <ul class="space-y-10 mb-10">
                    <li v-for="plugin in configuration.plugins">
                        <Plugin :plugin="plugin"
                                @set-edition="setEditionOnPlugin"
                                @remove="removePluginFromConfiguration"
                                class="flex group"/>
                    </li>
                </ul>
            </div>

            <div class="flex space-x-2">
                <t-rich-select v-model="pluginToAdd"
                               class="flex-grow"
                               value-attribute="handle"
                               text-attribute="name"
                               :minimumInputLength="2"
                               placeholder="Search for plugin"
                               :select-on-close="true"
                               :fetch-options="fetchPluginSearchOptions">
                    <template
                        slot="option"
                        slot-scope="{ index, isHighlighted, isSelected, className, option, query }">
                        <div :class="className">
                            <div class="flex-shrink-0">
                                <img
                                    class="w-10 h-10"
                                    :src="option.raw.icon_url"
                                    :alt="`Logo ${option.raw.name}`">
                            </div>
                            <div class="flex flex-col w-full ml-2 text-gray-800">
                                <strong>
                                    {{ option.raw.name }}
                                    <span v-if="isSelected">(Selected)</span>
                                </strong>
                                <span class="text-sm leading-tight text-gray-700">{{ option.raw.short_description }}</span>
                            </div>
                        </div>
                    </template>
                </t-rich-select>

                <t-button @click.prevent="onAdd">Add</t-button>
            </div>

            <t-table class="mt-8" :data="calculation"></t-table>

        </div>

    </Base>
</template>

<script>
import Base from "../Layouts/Base";
import Plugin from "../Components/Plugin";

export default {
    components: {Plugin, Base},

    props: {
        configuration: Object
    },

    data() {
        return {
            pluginToAdd: '',
            calculation: [[
                'Initial costs', '$500', '',
            ], [
                'Costs per renewal', '$100', '',
            ], [
                'Total costs per 24 months', '$600', '$25/month',
            ], [
                'Total costs per 36 months', '$700', '$19.44/month',
            ]]
        }
    },

    methods: {
        onAdd() {
            this.addPluginToConfiguration();
            this.pluginToAdd = '';
        },
        setEditionOnPlugin(pluginHandle, editionId) {
            this.$inertia.put(route('configuration.set-edition', {
                configuration: this.configuration,
                plugin: pluginHandle,
            }), {
                edition: editionId,
            });
        },
        addPluginToConfiguration() {
            this.$inertia.post(route('configuration.add-plugin', this.configuration), {
                handle: this.pluginToAdd,
            });
        },
        removePluginFromConfiguration(handle) {
            this.$inertia.delete(route('configuration.remove-plugin', {
                configuration: this.configuration,
                plugin: handle,
            }))
        },
        fetchPluginSearchOptions(query) {
            return window.axios.get(route('search'), {
                params: {query}
            }).then(response => {
                return {results: response.data.data};
            });
        }
    }
}
</script>
