<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Character
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

                        <p class="mb-4">
                            <label for="name">Island</label><br/>
                            <select name="island_id" id="island_id" size="1" v-model="form.island_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option v-for="(island,index) in islands" :value="island.id">{{ island.name }}</option>
                            </select>
                        </p>

                        <p>
                            <button type="submit"
                                    class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                Save
                            </button>
                            <a :href="route('characters.index')"
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
        'character',
        'islands',
    ],

    components: {
        AppLayout,
    },

    data() {
        return {
            form: {
                name: '',
                island_id: 0,
            }
        }
    },

    methods: {
        submit() {
            this.$inertia.put(route('characters.update', [this.character.id,]), this.form)
        },
    },

    mounted() {
        this.form.name = this.character.name;
        this.form.island_id = this.character.island_id;
    }
}
</script>
