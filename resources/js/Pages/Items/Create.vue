<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Item
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <form @submit.prevent="submit">
                        <p class="mb-4">
                            <label for="name">Name</label><br/>
                            <input type="text" name="name" id="name" v-model="form.name" autofocus class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        </p>

                        <p>
                            <button type="submit"
                                    class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                Save
                            </button>
                            <a :href="route('items.index')"
                               class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Cancel</a><br/>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: [
        'item',
    ],

    components: {
        AppLayout,
    },

    data() {
        return {
            form: {
                name: '',
            }
        }
    },

    methods: {
        submit() {
            this.$inertia.post(route('items.store'), this.form)
        },
    },

    mounted() {
        this.form.name = this.item.name;
    }
}
</script>
