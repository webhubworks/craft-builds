import TInput from 'vue-tailwind/dist/t-input'
import TButton from 'vue-tailwind/dist/t-button'
import TRichSelect from "vue-tailwind/dist/t-rich-select";
import TAlert from "vue-tailwind/dist/t-alert";
import TTable from "vue-tailwind/dist/t-table";
import TCard from "vue-tailwind/dist/t-card";
import TDropdown from "vue-tailwind/dist/t-dropdown";
import TModal from "vue-tailwind/dist/t-modal";

export default {
    't-dropdown': {
        component: TDropdown,
    },
    't-modal': {
        component: TModal,
    },
    't-rich-select': {
        component: TRichSelect,
        props: {
            variants: {
                minimal: {
                    selectButton: 'text-black transition duration-100 ease-in-out focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed mb-2'
                }
            },
        }
    },
    't-card': {
        component: TCard,
        props: {
            classes: {
                wrapper: 'border rounded shadow-sm bg-white border-gray-100',
                body: 'p-4 lg:p-12',
                header: 'border-b border-gray-100 p-3 rounded-t',
                footer: 'border-gray-100 border-t p-3 rounded-b',
            }
        }
    },
    't-table': {
        component: TTable,
    },
    't-alert': {
        component: TAlert,
        props: {
            fixedClasses: {
                wrapper: 'relative flex items-center p-4 border-l-4  rounded shadow-sm',
                body: 'flex-grow',
                close: 'absolute relative flex items-center justify-center ml-4 flex-shrink-0 w-6 h-6 transition duration-100 ease-in-out rounded focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50',
                closeIcon: 'fill-current h-4 w-4'
            },
            classes: {
                wrapper: 'bg-blue-50 border-blue-500',
                body: 'text-blue-700',
                close: 'text-blue-500 hover:bg-blue-200'
            },
            variants: {
                danger: {
                    wrapper: 'bg-red-50 border-red-500',
                    body: 'text-red-700',
                    close: 'text-red-500 hover:bg-red-200'
                },
                success: {
                    wrapper: 'bg-green-50 border-green-500',
                    body: 'text-green-700',
                    close: 'text-green-500 hover:bg-green-200'
                }
            }
        }
    },
    't-input': {
        component: TInput,
        props: {
            // classes: 'block w-full px-3 py-2 text-black placeholder-gray-400 transition duration-100 ease-in-out bg-white border border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed',
            // ...More settings
        }
    },
    't-button': {
        component: TButton,
        props: {
            fixedClasses: 'rounded block font-medium border border-transparent  transition duration-100 ease-in-out  disabled:opacity-50 disabled:cursor-not-allowed focus:ring-2 focus:ring-primary focus:outline-none focus:ring-opacity-50',
            classes: 'px-4 py-2 bg-primary hover:bg-black text-black hover:text-primary',
            variants: {
                big: 'px-6 py-3 text-2xl font-medium bg-primary hover:bg-black text-black hover:text-primary',
                text: 'bg-transparent hover:bg-transparent hover:text-black hover:underline'
            }
        }
    },
    't-link': {
        component: TButton,
        props: {
            tagName: 'a',
            fixedClasses: 'rounded block font-medium border border-transparent  transition duration-100 ease-in-out  disabled:opacity-50 disabled:cursor-not-allowed focus:ring-2 focus:ring-primary focus:outline-none focus:ring-opacity-50',
            classes: 'px-4 py-2 bg-primary hover:bg-black text-black hover:text-primary font-medium',
            variants: {
                big: 'px-6 py-3 text-2xl font-medium bg-primary hover:bg-black text-black hover:text-primary',
                text: 'bg-transparent hover:bg-transparent hover:text-black hover:underline',
                muted: 'bg-transparent hover:bg-transparent text-black opacity-60 hover:opacity-100 text-hover:text-black hover:underline',
            }
        }
    },
}
