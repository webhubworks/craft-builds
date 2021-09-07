<template>
    <div>
        <ConfigurationHeader></ConfigurationHeader>
        <Base>
            <div class="space-y-4 px-4">
                <t-card>

                    <div class="flex justify-between items-center mb-8 ">

                        <div class="group inline-flex items-end" v-if="!showBuildTitleInput">
                            <button @click="changeBuildTitle">
                                <span class="text-3xl font-medium py-1">{{ buildTitle }}</span>
                                <IconLabel icon="edit" label="Edit"
                                           classes="hidden group-hover:inline-flex font-normal print:hidden ml-2 edition-label__change inline text-gray-600 group-hover:text-blue-500 hover:text-black opacity-50 group-hover:opacity-100 border-b border-transparent hover:border-blue-500"></IconLabel>
                            </button>
                        </div>

                        <div class="flex space-x-2 print:hidden" v-if="showBuildTitleInput">
                            <t-input
                                name="buildTitleInput"
                                v-model="buildTitle"
                                variant="big"
                                ref="buildTitleInput"
                            />
                            <t-button
                                @click.prevent="saveBuildTitle">
                                {{ saveButton }}
                            </t-button>
                        </div>

                        <ConfigurationSettings
                            @currency-change="setCurrency"
                            @locale-change="setLocale"/>
                    </div>


                    <div v-if="configuration">
                        <div v-if="paidPlugins.length">
                            <h2 class="font-semibold text-sm text-gray-500 my-0"
                                :class="(paidPlugins.length && freePlugins.length) ? 'opacity-100': 'opacity-0'">Paid
                                plugins</h2>
                            <ul class="mb-10 divide-y divide-bg-400">
                                <li class="py-8" v-for="(plugin, index) in paidPlugins">
                                    <Plugin :plugin="plugin"
                                            :index="index"
                                            @set-edition="setEditionOnPlugin"
                                            @remove="removePluginFromConfiguration"
                                            class="group w-full"/>
                                </li>
                            </ul>
                        </div>
                        <div v-if="freePlugins.length">
                            <h2 class="font-semibold text-sm text-gray-500 my-0"
                                :class="(paidPlugins.length && freePlugins.length) ? 'opacity-100': 'opacity-0'">Free
                                plugins</h2>
                            <ul class="mb-10 divide-y divide-bg-400">
                                <li class="py-8" v-for="(plugin, index) in freePlugins">
                                    <Plugin :plugin="plugin"
                                            :index="index"
                                            @set-edition="setEditionOnPlugin"
                                            @remove="removePluginFromConfiguration"
                                            class="group w-full"/>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <h3 class="mt-8 print:hidden">Add a plugin to the build</h3>

                    <div class="flex space-x-2 print:hidden">
                        <t-rich-select v-model="pluginToAdd"
                                       class="flex-grow"
                                       value-attribute="handle"
                                       text-attribute="name"
                                       :minimumInputLength="2"
                                       variant="full"
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
                                        <span class="text-sm leading-tight text-gray-700">{{
                                                option.raw.short_description
                                            }}</span>
                                    </div>
                                    <div class="text-xs text-right ml-auto flex space-x-2 font-semibold">
                                        <span
                                            v-for="price in option.raw.editions.map(edition => edition.price || 'free')"
                                            class="rounded p-1 bg-black text-white leading-none">
                                            {{ price }}
                                        </span>
                                    </div>
                                </div>
                            </template>
                        </t-rich-select>

                        <t-button @click.prevent="onAdd">Add</t-button>
                    </div>


                </t-card>

                <div class="flex flex-col lg:flex-row justify-between lg:space-x-4">

                    <t-card class="order-1 lg:order-0 lg:w-1/2">
                        <div>
                            <h2 class="mt-0 print:mt-12">Share this build</h2>
                            <p class="hidden print:block break-all">
                                {{ shareLink }}
                            </p>
                            <div class="flex space-x-2 print:hidden">
                                <label class="sr-only">Share this build</label>
                                <t-input
                                    readonly
                                    name="share-link"
                                    v-model="shareLink"
                                    ref="shareInput"
                                />
                                <t-button
                                    @click.prevent="copyShareUrl">
                                    {{ shareButton }}
                                </t-button>
                            </div>
                        </div>
                    </t-card>


                    <t-card class="order-0 lg:order-1 mb-4 lg:mb-0 lg:w-1/2" variant="primary">
                        <div>
                            <h2 class="mt-0">License fees</h2>

                            <div class="grid grid-cols-2 w-full">
                                <div class="mb-4">
                                    <div class="flex items-center space-x-1">
                                        <label class="font-semibold text-sm text-gray-500">Initial</label>
                                        <Tooltip
                                            text="These fees are due once when you publish your project."></Tooltip>
                                    </div>
                                    <p class="text-lg font-bold mb-0">{{ calculation.initial }}</p>
                                </div>

                                <div class="mb-4">
                                    <div class="flex items-center space-x-1">
                                        <label class="font-semibold text-sm text-gray-500">Per renewal</label>
                                        <Tooltip
                                            text="These fees are due annually to ensure that you continue to receive updates. (one year after release at the earliest)"></Tooltip>
                                    </div>
                                    <p class="text-lg font-bold mb-0">{{ calculation.renewal }}</p>
                                </div>

                                <div class="space-y-1">
                                    <div class="flex items-center space-x-1">
                                        <label class="font-semibold text-sm text-gray-500">For 24 months</label>
                                    </div>
                                    <p><span class="font-bold">{{
                                            calculation.biAnnual
                                        }}</span><br>{{ calculation.biAnnualPerMonth }}/month</p>
                                </div>

                                <div class="space-y-1">
                                    <div class="flex items-center space-x-1">
                                        <label class="font-semibold text-sm text-gray-500">For 36 months</label>
                                    </div>
                                    <p><span class="font-bold">{{
                                            calculation.triAnnual
                                        }}</span><br>{{ calculation.triAnnualPerMonth }}/month</p>
                                </div>

                            </div>
                        </div>
                    </t-card>


                </div>
            </div>

        </Base>

        <BaseFooter></BaseFooter>
    </div>
</template>

<script>
import Base from "../Layouts/Base";
import Plugin from "../Components/Plugin";
import ConfigurationSettings from "../Components/ConfigurationSettings";
import Tooltip from "../Components/Tooltip";
import ConfigurationHeader from "../Components/ConfigurationHeader";
import BaseFooter from "../Components/BaseFooter";
import IconLabel from "../Components/IconLabel";

export default {
    components: {IconLabel, BaseFooter, ConfigurationHeader, Tooltip, ConfigurationSettings, Plugin, Base},

    props: {
        configuration: Object,
        calculation: Object,
        showBuildTitleInput: false
    },

    data() {
        return {
            pluginToAdd: '',
            buildTitle: 'New build',
            saveButton: 'Save',
            shareButton: 'Copy',
            shareLink: route('configuration', {
                configuration: this.configuration,
                currency: this.$page.props.selectedCurrency
            })
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
            }, {preserveScroll: true});
        },
        addPluginToConfiguration() {
            this.$inertia.post(route('configuration.add-plugin', this.configuration), {
                handle: this.pluginToAdd,
            }, {preserveScroll: true});
        },
        removePluginFromConfiguration(handle) {
            this.$inertia.delete(route('configuration.remove-plugin', {
                configuration: this.configuration,
                plugin: handle,
            }), {preserveScroll: true})
        },
        setCurrency(currency) {
            this.$inertia.visit(route('configuration', {
                configuration: this.configuration,
                currency: currency,
            }));
        },
        setLocale(locale) {
            this.$inertia.post('/lll', {locale});
        },
        fetchPluginSearchOptions(query) {
            return window.axios.get(route('search'), {
                params: {query}
            }).then(response => {
                return {results: response.data.data};
            });
        },
        copyShareUrl() {
            this.$refs.shareInput.select()
            try {
                let successful = document.execCommand('copy');
                this.shareButton = successful ? 'Copied' : 'Failed';
            } catch (err) {
                alert('Oops, unable to copy');
            }
            window.getSelection().removeAllRanges()
            this.$refs.shareInput.blur()
            setTimeout(() => {
                this.shareButton = 'Copy'
            }, 1200);
        },
        changeBuildTitle() {
            this.showBuildTitleInput = !this.showBuildTitleInput;
        },
        saveBuildTitle() {
            this.showBuildTitleInput = !this.showBuildTitleInput;
        }
    },

    computed: {
        paidPlugins() {
            return this.configuration.plugins.filter((plugin) => {
                return plugin.pivot.edition.price !== null;
            }).sort((a, b) => a.name.localeCompare(b.name))
        },
        freePlugins() {
            return this.configuration.plugins.filter((plugin) => {
                return plugin.pivot.edition.price === null;
            }).sort((a, b) => a.name.localeCompare(b.name))
        }
    }
}
</script>
